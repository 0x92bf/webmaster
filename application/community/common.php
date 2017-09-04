<?php
function comEncry($data){
    return md5(md5($data));
}
