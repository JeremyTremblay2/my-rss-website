<?php
if(isset($dark) && $dark==2){
    echo "<link type='text/css' rel='stylesheet' href='views/css/RSS.css'>";
}
else{
    echo "<link type='text/css' rel='stylesheet' href='views/css/RSSDark.css'>";
}