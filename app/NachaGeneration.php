<?php
	
	class NachaFile {

	    const LINES_GLUE = "\n"; // \n = LF, \r\n = CRLF

	    private $fileId;
	    private $companyId;
	    private $settlementAccount;
	    public $detailRecordCount = 0;
	    private $routingHash = 0;
	    public $creditTotal = 0;
	    public $debitTotal = 0;
	    public $errorRecords = array();
	    public $processedRecords = array();
	    private $tranid = 0;
	    private $bankrt;
	    private $filemodifier ='A';
	    private $originatingBank;
	    private $companyName;
	    private $scc = '200';
	    private $sec = 'PPD';
	    private $description = 'PAYMENT';
	    private $descriptionDate;
	    private $entryDate;
	    private $fileHeader = '';
	    public $validFileHeader = false;
	    private $batchHeader = '';
	    public $validBatchHeader = false;
	    private $batchInfo = '';
	    private $batchLines = '';
	    private $batchNumber = '1';
	    private $batchFooter = '';
	    public $validBatchFooter = false;
	    private $fileFooter = '';
	    public $validFileFooter = false;
	    private $recordsize = '094';
	    private $blockingfactor = '10';
	    private $formatcode = '1';
	    private $referencecode = '        ';
	    public $fileContents = '';
	    public $paymenttypecode = '';
	    // Takes money from someone else account and puts it in yours
	    public function addDebit($paymentinfo){
	        if (!is_array($paymentinfo))    return false;
	        if (!isset($paymentinfo['Transcode'])) {
	            if ($paymentinfo['AccountType']) {
	                if ($paymentinfo['AccountType'] == 'CHECKING') {
	                    $paymentinfo['Transcode'] = '27';
	                } else if ($paymentinfo['AccountType'] == 'SAVINGS') {
	                    $paymentinfo['Transcode'] = '37';
	                } else {
	                    return false;
	                }
	            } else {
	                $paymentinfo['Transcode'] = '27';
	            }
	        }
	        $this->addDetailLine($paymentinfo);
	        return true;
	    }

	    // Takes money from your account and puts it into someone elses.
	    public function addCredit($paymentinfo) {
	        if (!is_array($paymentinfo))    return false;
	        if (!isset($paymentinfo['Transcode'])) {
	            if ($paymentinfo['AccountType']) {
	                if ($paymentinfo['AccountType'] == 'CHECKING') {
	                    $paymentinfo['Transcode'] = '22';
	                } else if ($paymentinfo['AccountType'] == 'SAVINGS') {
	                    $paymentinfo['Transcode'] = '32';
	                } else {
	                    return false;
	                }
	            } else {
	                $paymentinfo['Transcode'] = '22';
	            }
	        }
	        $this->addDetailLine($paymentinfo);
	        return true;
	    }

	    private function addDetailLine($paymentinfo) {
	        if (/*!$paymentinfo['AccountNumber'] ||*/ !$paymentinfo['TotalAmount'] || !$paymentinfo['BankAccountNumber'] || !$paymentinfo['RoutingNumber'] || !$paymentinfo['FormattedName'] || !$paymentinfo['AccountType']) {
	            return false;
	        }
	        $paymentinfo['TranId'] = $this->tranid + 1;
	        if ($this->createDetailRecord($paymentinfo)) {
	            array_push($this->processedRecords, $paymentinfo);
	            $this->tranid ++;
	            return true;
	        } else {
	            $paymentinfo['TranId'] = false;
	            array_push($this->errorRecords, $paymentinfo);
	            return false;
	        }
	        return true;
	    }

	    public function setCompanyId($companyId) {
	        $this->companyId = $companyId;
	        return $this;
	    }

	    public function setSettlementAccount($settlementAccount) {
	        $this->settlementAccount = $settlementAccount;
	        return $this;
	    }

	    public function setFileID($fileId) {
	        $this->fileId = $fileId;
	        return $this;
	    }

	    public function setBankRT($rt) {
	        $this->bankrt = $rt;
	        return $this;
	    }

	    public function setOriginatingBank($originatingBank) {
	        $this->originatingBank = $originatingBank;
	        return $this;
	    }

	    public function setFileModifier($filemodifier) {
	        $this->filemodifier = $filemodifier;
	        return $this;
	    }

	    public function setCompanyName($companyName) {
	        $this->companyName = $companyName;
	        return $this;
	    }

	    public function setServiceClassCode($scc) {
	        $this->scc = $scc;
	        return $this;
	    }

	    public function setSECCode($sec) {
	        $this->sec = $sec;
	        return $this;
	    }

	    public function setRecordSize($size) {
	        $this->recordsize = $size;
	        return $this;
	    }

	    public function setBlockingFactor($block) {
	        $this->blockingfactor = $block;
	        return $this;
	    }

	    public function setFormatCode($code) {
	        $this->formatcode = $code;
	        return $this;
	    }

	    public function setReferenceCode($code) {
	        $this->referencecode = $code;
	        return $this;
	    }

	    public function setBatchInfo($batchinfo) {
	        $this->batchInfo = $batchinfo;
	        return $this;
	    }

	    public function setDescription($des = false, $date = false) {
	        if($des)$this->description = $des;
	        if($date)$this->descriptionDate = date('M d', strtotime($date));
	        return $this;
	    }

	    public function setEntryDate($date) {
	        $this->entryDate = date('ymd', strtotime($date));
	        return $this;
	    }
		
	     public function setPaymentTypeCode($type) {
	        $this->paymenttypecode = $type;
	        return $this;
	    }

	    public function generateFile($filemodifier = false) {
	        if ($filemodifier)$this->setFileModifier($filemodifier);
	        $this->createFileHeader();
	        $this->createBatchHeader();
	        $this->createBatchFooter();
	        $this->createFileFooter();
	        if (!$this->validFileHeader) {
	            throw new Exception('Invalid File Header');
	        }
	        if (!$this->validBatchHeader) {
	            throw new Exception('Invalid Batch Header');
	        }
	        if (!$this->validBatchFooter) {
	            throw new Exception('Invalid Batch Footer');
	        }
	        if (!$this->validFileFooter) {
	            throw new Exception('Invalid File Footer');
	        }
	        $this->fileContents = $this->fileHeader.$this::LINES_GLUE.$this->batchHeader.$this::LINES_GLUE.$this->batchLines.$this->batchFooter.$this::LINES_GLUE.$this->fileFooter;
	        return true;
	    }

	    private function createFileHeader() {
	        $this->fileHeader = '101 '.$this->bankrt.$this->fileId.date('ymdHi').$this->filemodifier.$this->recordsize.$this->blockingfactor.$this->formatcode.$this->formatText($this->originatingBank, 23).$this->formatText($this->companyName, 23).$this->formatText($this->referencecode, 8);
	        if (strlen($this->fileHeader) == 94) $this->validFileHeader = true;
	        return $this;
	    }

	    private function createBatchHeader() {
	        $this->batchHeader = '5'.$this->scc.$this->formatText($this->companyName,16).$this->formatText($this->batchInfo,20).$this->companyId.$this->sec.$this->formatText($this->description, 10).$this->formatText($this->descriptionDate, 6).$this->entryDate.'   1'.substr($this->bankrt, 0, 8).$this->formatNumeric($this->batchNumber, 7);
	        if (strlen($this->batchHeader) == 94) $this->validBatchHeader = true;
	        return $this;
	    }

	    private function createDetailRecord($info) {
	        $line = '6'.$info['Transcode'].$this->formatText($info['RoutingNumber'], 9).$this->formatText($info['BankAccountNumber'], 17).$this->formatNumeric(number_format($info['TotalAmount'], 2), 10).$this->formatText($info['AccountNumber'], 15).$this->formatText($info['FormattedName'], 22). $this->formatText($this->paymenttypecode, 2). '0'.substr($this->bankrt, 0, 8).$this->formatNumeric($info['TranId'], 7);
	        if (strlen($line) == 94) {
	            $this->batchLines .= $line.$this::LINES_GLUE;
	            $this->detailRecordCount ++;
	            $this->routingHash += (int)substr($info['RoutingNumber'], 0, 8);
	            if ($info['Transcode'] == '27' || $info['Transcode'] == '37') {
	                $this->debitTotal += (float)$info['TotalAmount'];
	            } else {
	                $this->creditTotal += (float)$info['TotalAmount'];
	            }
	            return true;
	        }
	        return false;
	    }

	    private function createBatchFooter() {
	        $this->batchFooter = '8'.$this->scc.$this->formatNumeric($this->detailRecordCount, 6).$this->formatNumeric($this->routingHash, 10).$this->formatNumeric(number_format($this->debitTotal, 2), 12).$this->formatNumeric(number_format($this->creditTotal, 2), 12).$this->formatText($this->companyId, 10).$this->formatText('', 25).substr($this->bankrt, 0, 8).$this->formatNumeric($this->batchNumber, 7);
	        if (strlen($this->batchFooter) == 94) $this->validBatchFooter = true;
	        return $this;
	    }

	    private function createFileFooter() {
	        $linecount = $this->detailRecordCount + 4;
	        $blocks = ceil(($linecount) / 10);
	        $this->fileFooter = '9'.$this->formatNumeric('1', 6).$this->formatNumeric($blocks, 6).$this->formatNumeric($this->detailRecordCount, 8).$this->formatNumeric($this->routingHash, 10).$this->formatNumeric(number_format($this->debitTotal, 2), 12).$this->formatNumeric(number_format($this->creditTotal, 2), 12).$this->formatText('', 39);
	        if (strlen($this->fileFooter) == 94) $this->validFileFooter = true;
	        // Add any additional '9' lines to get something evenly divisable by 10.
	        $fillersToAdd = ($blocks * 10) - $linecount;
	        for ($i = 0; $i < $fillersToAdd; $i ++) {
	            $this->fileFooter .= $this::LINES_GLUE.str_pad('', 94, '9');
	        }
	        return $this;
	    }

	    private function formatText($txt, $spaces) {
	        return substr(str_pad(strtoupper($txt), $spaces, ' ', STR_PAD_RIGHT), 0, $spaces);
	    }

	    private function formatNumeric($nums, $spaces) {
	        return substr(str_pad(str_replace(array('.', ','), '', (string)$nums), $spaces, '0', STR_PAD_LEFT), ($spaces) * -1);
	    }
	}

	class NachaGeneration {
		public static function generateFile($cap_table, $investors, $description, $property_name, $start_date) {
			$nacha = new NachaFile();
			$header = $cap_table[0];
			$nacha->setBankRT($header['routing'])// Your bank's routing number
			->setCompanyId($header['tax_id'])// Usually your company Fed tax id with something the bank tells you to put on the front.
			->setSettlementAccount($header['account']) // Your bank account you want the money to go into
			->setFileID($header['tax_id'])// Probably the same as your Company ID but your bank will tell you what this should be.
			->setOriginatingBank('UMPQUA BANK')// Text name of your bank
			->setFileModifier('A')// Usually just A - for the first file of the day.  Change to 'B' for second file of the day and so on.
			->setCompanyName($header['name'])//16 chars - your company name
			->setBatchInfo('') // Text description for the batch
			->setDescription($description, $start_date) // Description shown on customers statements and date of invoice
			->setEntryDate(date('m/d/Y')); // The day you want the payments to be processed. This example shows today.

			foreach($investors as $count => $row) {
				if($row->account_number) {
					$payment = array("AccountNumber" => '',
					"TotalAmount" => $row->calc_amount,
					"BankAccountNumber" => $row->account_number,
					"RoutingNumber" => $row->routing_number,
					"FormattedName" => $row->entity_name,
					"AccountType" => strtoupper($row->type));
					if (!$nacha->addCredit($payment)) {
						print_r($nacha->errorRecords);
					}	
				}
			}
			try{
			    $nacha->generateFile();
				// Put the file contents on the file system
				$filename = $description.'_'.$property_name.'_NACHA_file.txt';
				$dataForFile="test data to be returned to user in a file";

				header('Content-type: application/x-download');
				header('Content-Disposition: attachment; filename="'.$filename.'"');
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.strlen($nacha->fileContents));
				set_time_limit(0);
				echo $nacha->fileContents;

			}catch(Exception $e){
			    // Something went wrong with the file generation
			    print_r($e->getMessage());
			}
		}	
	}
?>