<?php

use Carbon\Carbon;

$year = now()->year;
// $year = Carbon::parse(now())->format('Y');
?>
<footer class="app-footer d-flex justify-content-center">
    <!-- <div class="float-end d-none d-sm-inline">
        Anything you want
    </div> -->

    <span>
        Copyright &copy; {{ $year }} All rights reserved.
    </span>


</footer>
