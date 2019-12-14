// Must be an HTML5 File object
var file = new File([], "test.iso");
var fileId = "8675309";

var box = new BoxSdk();
// Uses XHR to perform chunked upload
var client = new box.BasicBoxClient({ accessToken: accessToken });

client.files.chunkedUpload({
  file: uploadedFile,
  name: uploadedFile.name,
  parentFolder: { id: "0" },
  listeners: {
    handleProgressUpdates: function (e) {
      console.log("Progress captured...");
      console.log("Percentage processed: ");
      console.log(e.detail.progress.percentageProcessed);
      console.log("Percentage uploaded: ");
      console.log(e.detail.progress.percentageUploaded);
    },
    getIsCancellingNotification: function (e) {
      console.log("Started cancelling!");
      console.log(e.detail.progress)
    },
    getIsCancelledNotification: function (e) {
      console.log("Finished cancelling!");
      console.log(e.detail.progress)
    },
    getFailureNotification: function (e) {
      console.log("Failed!");
      console.log(e.detail.progress.didFail)
    },
    getSuccessNotification: function (e) {
      console.log("Success!");
      console.log(e.detail.progress.didSucceed)
    },
    getStartNotification: function (e) {
      console.log("Upload started!");
      console.log(e.detail.progress.didStart)
    },
    getFileCommitNotification: function (e) {
      console.log("File committed!");
      console.log(e.detail.progress.didFileCommit)
    },
    getSessionCreatedNotification: function (e) {
      console.log("Session created!");
      console.log(e.detail.progress.didSessionStart)
    },
    getCompletedNotification: function (e) {
      console.log("Upload completed!");
      console.log(e.detail.progress.isComplete)
    }
  }
})
  .then(function (resp) {
    // Uploads file if there is no name conflict in this folder.
    // Otherwise, a 409 error is thrown due to a file conflict.
  })
  .catch(function (e) {
    if (e.status === 409) {
      var fileId;
      if (e.data && e.data.context_info && e.data.context_info.conflicts && e.data.context_info.conflicts.id) {
        fileId = e.data.context_info.conflicts.id;
      } else if (e.response && e.response.context_info && e.response.context_info.conflicts && e.response.context_info.conflicts.id) {
        fileId = e.response.context_info.conflicts.id;
      }
      if (fileId) {
        // Try to upload the file as a new version of the existing file
        return client.files.chunkedUploadNewFileVersion({
          file: uploadedFile,
          name: uploadedFile.name,
          id: fileId
        });
      }
    }
  })
  .then(function (resp) {
    if (resp) {
      console.log("Uploaded new file version");
      console.log(resp);
    }
  });