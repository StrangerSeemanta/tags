<?php
if (isset($_POST['read'])===true) {
    $fname = $_POST['read'];
    $fstream = 'saved tags/'.$fname;
    if (file_exists($fstream)) {
        $thisFile = fopen($fstream,'r') or die('Cant read file');
        $contents = fread($thisFile,filesize($fstream));
        $preview = '<div class="result-container">
        <h1>'.$fname.'</h1>
        <div class="resultBox"><p id="resultText">'.$contents.'</p></div>
        <div class="btn-holder"><button title="Save these tags into your computer" onclick="showModal()">Save</button>
    <div class="tooltip">
        <button onclick="myFunction()" >
        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
            Copy text
        </button>
    </div>
    <div class="tooltip">
        <button onclick="reset()" >
        <span class="tooltiptext" id="myTooltip">Reset results</span>
            Reset All
        </button>
    </div>
    </div>
        </div>';

        header("Content-Type: text/html");
        header("Content-Length: " . strlen($preview));

        echo $preview;
    }else{
        $error = '<div class="result-container">
        <h1>Error Happened</h1>
        <div class="resultBox"><p id="resultText">Filename does not exist!!!</p></div>
        </div>';

        echo $error;
    }
};
if (isset($_POST['rem']) === true) {
    $ftarget = $_POST['rem'];
    $fstream = 'saved tags/'.$ftarget;
    if (file_exists($fstream)) {
        unlink($fstream);
        $msg = '<div class="result-container">
        <h1>Remove Saved File</h1>
        <div class="resultBox"><p id="resultText">File Removed Successfully</p></div>
        <div class="tooltip">
        <button onclick="toMainPage()" >
        <span class="tooltiptext" id="myTooltip">Go to Main page</span>
            Go Back
        </button>
        </div>
        </div>';

        echo $msg;

        
    }else {
        $error = '<div class="result-container">
        <h1>Error Happened</h1>
        <div class="resultBox"><p id="resultText">Filename does not exist!!!</p></div>
        <div class="tooltip">
        <button onclick="toMainPage()" >
        <span class="tooltiptext" id="myTooltip">Go to Main page</span>
            Go back
        </button>
    </div>
        </div>';

        echo $error;
    }
    
}
?>