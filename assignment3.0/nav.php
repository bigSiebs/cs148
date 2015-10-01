<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php

        // If a valid query number hasn't been picked, display list.
        
        $numQueries = 8;
        for ($i = 1; $i <= $numQueries; $i++) {
            print '<li>q' . $i . ". ";
            print '<a href="?query=' . $i . '">SQL:' . '</a>';
            print ' QUERY TEXT HERE' . '</li>';
        }
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

