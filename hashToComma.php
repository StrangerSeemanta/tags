<?php
session_start();

$hashtags = filter_input(INPUT_POST, 'withHash');
$separator = '#';
$result = hashtagToCommatag($hashtags, $separator);

$_SESSION['converted'] = htmlspecialchars($result);
$_SESSION['hashtags'] = htmlspecialchars($hashtags);

$node = '<div class="result-container">
                <h1>Tags with comma</h1>
                <div class="resultBox"><p id="resultText">'.$result.'</p></div>
                <div class="btn-holder"><button title="Save these tags into your computer" onclick="showModal()">Save</button>
                <div class="tooltip">
                    <button onclick="myFunction()" >
                    <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                        Copy text
                    </button>
                </div></div>
                </div>';
// Send result
header("Content-Type: text/html");
header("Content-Length: " . strlen($node));
echo $node;

exit;

function hashtagToCommatag($tags, $delim) {
    $tagsArray = array_filter(array_map('trim', explode($delim, $tags)));

    return implode(',', $tagsArray);
}
 ?>
