<?php
print <<<_HTML_
    <form method="post" action="$_SERVER[PHP_SELF]">
    Your Name:<input type="text" name="user" />
    <br/>
    <button type="submit" class="btn btn-primary">Say World</button>
    </form>
_HTML_;
?>