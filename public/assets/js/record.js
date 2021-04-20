//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; //stream from getUserMedia()
var rec; //Recorder.js object
var input; //MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var counter;

$("#start_record").click(function() {
    /*
        	Simple constraints object, for more advanced audio features see
        	https://addpipe.com/blog/audio-constraints-getusermedia/
        */

    var constraints = { audio: true, video: false }

    $(this).hide();
    $("#cancel_record").show();
    $("#send_record").show();
    $("#counter").show();

    counter = setInterval(function() {
        var second = parseInt($('#sec').html()) + 1;
        var minute = parseInt($('#min').html());
        if (second == 60) {
            second = 00;
            minute++;
        }
        if (second < 10) {
            second = '0' + second;
        }
        if (minute < 10) {
            minute = '0' + minute;
        }
        $('#sec').html(second);
        $('#min').html(minute);
    }, 1000);

    /*
        We're using the standard promise based getUserMedia() 
        https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
    */

    navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {

        /*
                    create an audio context after getUserMedia is called
                    sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
                    the sampleRate defaults to the one set in your OS for your playback device
    
                */
        audioContext = new AudioContext();

        /*  assign to gumStream for later use  */
        gumStream = stream;

        /* use the stream */
        input = audioContext.createMediaStreamSource(stream);

        /* 
            Create the Recorder object and configure to record mono sound (1 channel)
            Recording 2 channels  will double the file size
        */
        rec = new Recorder(input, { numChannels: 1 })

        //start the recording process
        rec.record()

        $.ajax({
            type: "POST",
            url: "/record-status/" + $("#chat_id").val()
        })

    }).catch(function(err) {
        //enable the record button if getUserMedia() fails
        $(this).show();
        $("#cancel_record").hide();
        $("#send_record").hide();
        $("#counter").hide();
    });
})

$("#cancel_record").click(function() {
    //enable the record too allow for new recordings
    $('#start_record').show();
    $(this).hide();
    $("#send_record").hide();
    clearInterval(counter);
    $('#sec').html('00');
    $('#min').html('00');
    $("#counter").hide();

    //tell the recorder to stop the recording
    rec.stop();

    //stop microphone access
    gumStream.getAudioTracks()[0].stop();

    $.ajax({
        type: "POST",
        url: "/record-status"
    })
})

$("#send_record").click(function() {
    //enable the record too allow for new recordings
    $('#start_record').show();
    $("#cancel_record").hide();
    $(this).hide();
    clearInterval(counter);
    $('#sec').html('00');
    $('#min').html('00');
    $("#counter").hide();

    //tell the recorder to stop the recording
    rec.stop();

    //stop microphone access
    gumStream.getAudioTracks()[0].stop();

    $.ajax({
        type: "POST",
        url: "/record-status"
    })

    //create the wav blob and pass it on to createDownloadLink
    rec.exportWAV(createDownloadLink);
})

function createDownloadLink(blob) {

    //name of .wav file to use during upload and download (without extendion)
    var filename = new Date().toISOString();

    //upload link
    var fd = new FormData();
    fd.append("audio_data", blob, filename);
    fd.append("chat_id", $("#chat_id").val());
    fd.append("user_id", $("#user_id").val());
    $.ajax({
        type: "POST",
        url: "/send_record",
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != "error") {
                $("#chat_id").val(response);
                reloadChat(true);
                allChat();
            }
        }
    })
}