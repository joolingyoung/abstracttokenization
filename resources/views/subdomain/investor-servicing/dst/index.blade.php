@extends('subdomain.investor-servicing.dst.main-template')
@section('title', "Reports > Investor Servicing")

@section('body')
<div class="card margin-top-m">
                    <div class="card-title blue">
                        <h5>Reports</h5></div>
                    <div class="card-content">
                        <div class="row middle-xs">
                            <div class="col-xs-12 col-md-6">
                                <div class="marketplace-card-image porperty-image">
                                    <div class="marketplace-card-image-description">
                                        <h5>{{!empty($data) ? $data->name : '' }}</h5>
                                        <p class="color-white">@if (isset($type) &&  $type === 'property')
                                            Property digital security

                                        @elseif (isset($type) &&  $type === 'sproperty')
                                            Property
                                        @else
                                            Fund digital security
                                        @endif</p>
                                    </div>
                                    @if ($type === 'fund')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="fund-digital-security"
                                            path="/digital-security/fund/photo-gallery/"
                                            index="0">
                                        </file-preview>
                                    @elseif ($type === 'property')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="digital-security"
                                            path="/digital-security/photo-gallery/"
                                            index="0">
                                        </file-preview>
                                    @elseif ($type === 'sproperty')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{$data->userid}}"
                                            field="property-image"
                                            path="/property/images/"
                                            index="0"
                                            section="investor-servicing-files"
                                            sectionid="{{$data->id}}">
                                        </file-preview>
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-12 col-md-6 text-center">
                                <h2>Investor Report</h2>
                                <p>Investor: {{ Auth::user()->first_name. ' ' .Auth::user()->last_name }}</p>
                                <p>{{ date('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="card grey margin-top-m">
                    <div class="card-title blue">
                        <h5>DST Financial Report:</h5>
                    </div>
                    <div class="card-content">
                        <div class="table-grid">
                            <div class="row middle-xs margin-bottom-s">
                                <div class="col-xs-12 col-md-4">
                                    <h3>Rental Income</h3>
                                </div>
                                <div class="col-xs-12 col-md-4 hide-sm">
                                    <h5>Current</h5>
                                </div>
                                <div class="col-xs-12 col-md-4 hide-sm">
                                    <h5>YTD</h5>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Base Rent</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->base_rent_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->base_rent_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Annual Rent</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->annual_rent_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->annual_rent_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Percentage Rent</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->percentage_rent_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->percentage_rent_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-m">
                                <div class="col-xs-12 col-md-4">
                                    <p>Total Rental Income</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->total_rental_income_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->total_rental_income_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-s">
                                <div class="col-xs-12 col-md-4">
                                    <h3>Expenses</h3>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Interest Expense</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->interest_expense_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->interest_expense_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Real Estate Taxes</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->real_estate_taxes_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->real_estate_taxes_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Insurance</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->insurance_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->insurance_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Lender Reserves</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->lender_reserves_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->lender_reserves_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Signatory Trustee Fee</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->signatory_trustee_fee_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->signatory_trustee_fee_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Independent Trustee Fee</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->independent_trustee_fee_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->independent_trustee_fee_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Total Expenses</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->total_expenses_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->total_expenses_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-m">
                                <div class="col-xs-12 col-md-4">
                                    <p>Net Income beore Depreciation/Amrortization*</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($dst_data->net_income_before_depr)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($dst_data->net_income_before_amort)}}</p>
                                </div>
                            </div>
                        </div>
                        <p>*Depreciation must be calculated at the trustee level due to the nature of initial
                            investments that may, oor may not, have utilized IRC Section 1031 to defer gaines on
                            prior investment(s). Please consult your tax advisor for an estimate of this amount.
                        </p>
                    </div>
                </div>
                <div class="card grey margin-top-m">
                    <div class="card-title blue">
                        <h5>Operational Highlights</h5>
                    </div>
                    <div class="card-content">
                        <div class="table-grid">
                            <div class="row middle-xs margin-bottom-s">
                                <div class="col-xs-12 col-md-4">
                                    <h3>Mortgage Information</h3>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Current Principal Balance</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->current_principal_balance)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Annual Interest Rate</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>{{number_format($operation_data->annual_interest_rate * 100, 2)}}%</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-m">
                                <div class="col-xs-12 col-md-4">
                                    <p>Maturity Date</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>{{$operation_data->maturity_date}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-s">
                                <div class="col-xs-12 col-md-4">
                                    <h3>Reserve Balances</h3>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Tax Escrow</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->tax_escrow)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Insurance Escrow</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->insuarance_escrow)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p>Replacement Reserve Escrow</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->replacement_reserve_escrow)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-m">
                                <div class="col-xs-12 col-md-4">
                                    <p>Total Lender Reserves</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->total_lender_reserves)}}</p>
                                </div>
                            </div>
                            <div class="row margin-bottom-m">
                                <div class="col-xs-12 col-md-4">
                                    <h3>DST Reserves</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p>Trust Reserve</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->trust_reserve)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p>Total DST Reserves</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->total_dst_reserves)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p>Total Reserves</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($operation_data->total_reserves)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p>Occupancy Rate</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>{{number_format($operation_data->occupancy_rate * 100, 2)}}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card grey margin-top-m">
                    <div class="card-title blue">
                        <h5>Property Financial Highlights</h5>
                    </div>
                    <div class="card-content">
                        <div class="table-grid">
                            <div class="row middle-xs margin-bottom-s">
                                <div class="col-xs-12 col-md-4">
                                    <h3>Rental Income</h3>
                                </div>
                                <div class="col-xs-12 col-md-4 hide-sm">
                                    <h5>Current</h5>
                                </div>
                                <div class="col-xs-12 col-md-4 hide-sm">
                                    <h5>YTD</h5>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Rental Income</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->rental_income_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->rental_income_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Other Rental Income</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->other_rental_income_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->other_rental_income_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-m">
                                <div class="col-xs-12 col-md-4">
                                    <p>Total Rental Income</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->total_rental_income_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->total_rental_income_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs margin-bottom-s">
                                <div class="col-xs-12 col-md-4">
                                    <h3>Operating Costs:</h3>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Administrative</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->administrative_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->administrative_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Payroll</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->payroll_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->payroll_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Marketing</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->marketing_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->marketing_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Utilities</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->utilities_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->utilities_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Repairs & Maintenance</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->repairs_maintenance_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->repairs_maintenance_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Grounds</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->grounds_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->grounds_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Other Operating</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->other_operating_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->other_operating_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Licenses & Permits</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->licenses_permits_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->licenses_permits_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Property Management Fees</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->property_management_fees_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->property_management_fees_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>RE Taxes</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->re_taxes_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->re_taxes_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Insurance</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->insurance_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->insurance_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Capital Activity</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->capital_activity_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->capital_activity_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Total Operating Costs</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->total_operating_costs_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->total_operating_costs_ytd)}}</p>
                                </div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-md-4">
                                    <p>Net Operating Costs</p>
                                </div>
                                <div class="col-xs-12 col-md-4 current">
                                    <p>${{number_format($property_data->net_operating_income_current)}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4 ytd">
                                    <p>${{number_format($property_data->net_operating_income_ytd)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card grey margin-top-m">
                    <div class="card-title blue">
                        <h5>Cash Distributions Summary</h5>
                    </div>
                    <div class="card-content">
                        <div class="table-grid">
                            <div class="row margin-bottom-s">
                                <div class="col-xs-12 col-md-8">
                                    <p>1. Cumulative Cash Distributions</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($cash_data->cumulative_cash_distribution)}}</p>
                                </div>
                            </div>
                            <div class="row margin-bottom-s">
                                <div class="col-xs-12 col-md-8">
                                    <p>2. Cumulative Annualized Cash Distribution as a % of original investment
                                    </p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>{{number_format($cash_data->cumulative_annualized * 100, 2)}}%</p>
                                </div>
                            </div>
                            <div class="row margin-bottom-s">
                                <div class="col-xs-12 col-md-8">
                                    <p>3. Pre-Tax Cumulative Annualized Cash Distributions as a % of original
                                        investment</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>{{number_format($cash_data->pre_tax_cumulative * 100, 2)}}%</p>
                                </div>
                            </div>
                            <div class="row margin-bottom-s">
                                <div class="col-xs-12 col-md-8">
                                    <p>4. Current Month Cash Distribution</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>${{number_format($cash_data->current_month_cash)}}</p>
                                </div>
                            </div>
                            <div class="row margin-bottom-s">
                                <div class="col-xs-12 col-md-8">
                                    <p>5. Current Month Annualized Cash Distributions as a % of original
                                        investment</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>{{number_format($cash_data->current_month_annualized * 100, 2)}}%</p>
                                </div>
                            </div>
                            <div class="row margin-bottom-s">
                                <div class="col-xs-12 col-md-8">
                                    <p>6. Pre-Tax Current Month Annualized Cash Distributions 
                                    as a % of original investment</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p>{{number_format($cash_data->pre_tax_current_annualized * 100, 2)}}%</p> <!-- Cant find Insurance Escrow field in the table-->
                                </div>
                            </div>
                            <div class="row margin-bottom-s">
                                <div class="col-xs-12 col-md-8">
                                    <p>Pre-Tax Returns calculated using the highest Federal Marginal tax rate of
                                        37% plus an 8% allowance for state and local tax</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="btn full-width margin-bottom-m-sm"><a href="/investor-servicing/download/reports/sproperty/{{$report_id}}" style="color: #fff !important; font-weight: 700 !important">PDF</a></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="btn dust full-width">CSV</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection