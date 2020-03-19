<div class="container pt-4">
    <?php
        $table = '<table class="table table-striped" style="width:100%"><tr>';
        $header = '';
        
        if(isset($data[0]))
        {
            foreach ($data[0] as $eKey => $eVal)
            {
                if($eKey != 'target_date')
                    $header .= "<th>".ucwords(str_replace('_', ' ', $eKey))."</th>";
            }
        }

        $header .= "</tr>";
        $table .= $header;
        $table .= "<tr><tbody>";
        foreach($employees as $key => $employee) 
        {
            foreach ($employee as $key => $value)
            {
                if($key != 'target_date')
                    $table .= "<td>".$value."</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</tbody></table>";
        echo $table;
    ?>
</div>