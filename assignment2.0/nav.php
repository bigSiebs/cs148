<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item
        
        $queryNumber = "";
        
        if (isset($_GET['queryNumber'])) {
                $queryNumber = (int)$_GET['queryNumber'];
        }
        
        for ($i = 1; $i <= 10; $i++) {
            if ($queryNumber == $i) {
                print '<li class="activePage">Query ' . $i . '</li>';
            } else {
                print '<li><a href="?queryNumber=' . $i . '">Query ' . $i . '</a></li>';
            }
        }
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

