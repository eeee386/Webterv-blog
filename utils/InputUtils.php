<?php
class InputUtils {
    /**
     * Creates an input error div to show the error on the page
     * @param $message string message to write in the div
     */
    public static function createInputError($message) {
        echo "<div class='inputError'>". $message ."</div>";
    }

    /**
     * Creates an input successful div to show if the input has been processed without an error.
     * @param $message string message to write in the div
     */
    public static function createInputSuccess($message) {
        echo "<div class='inputSuccess'>". $message ."</div>";
    }

    public static function prepNonEssentials($post_index) {
        if(empty($_POST[$post_index])){
            return null;
        } else {
            return $_POST[$post_index];
        }
    }
}

?>