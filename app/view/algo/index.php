<div class="container default-tab pt-4">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">Email Extract</a>
        </li>
        <li class="nav-item">
            <a class="get_therapists nav-link" id="therapists-tab" data-toggle="tab" href="#therapists" role="tab" aria-controls="therapists" aria-selected="false">Therapists Schedule</a>
        </li>
        <li class="nav-item">
            <a class="get_positions nav-link" id="positions-tab" data-toggle="tab" href="#positions" role="tab" aria-controls="positions" aria-selected="false">Employee Positions</a>
        </li>
        <li class="nav-item">
            <a class="get_logic nav-link" id="logic-tab" data-toggle="tab" href="#logic" role="tab" aria-controls="logic" aria-selected="false">SQL Query Logic</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
            <div class="container pt-4">
                <?php
                    if(isset($data['data']))
                    {
                        $table = '<table class="table table-striped" style="width:100%"><tr>';
                        $header = '';
                        
                        if(isset($data['data'][0]))
                        {
                            foreach ($data['data'][0] as $eKey => $eVal)
                            {
                                $header .= "<th>".ucwords(str_replace('_', ' ', $eKey))."</th>";
                            }
                        }
                    
                        $header .= "</tr>";
                        $table .= $header;
                        $table .= "<tr><tbody>";
                        foreach($data['data'] as $key => $employee) 
                        {
                            foreach ($employee as $key => $value)
                            {
                                $table .= "<td>".$value."</td>";
                            }
                            $table .= "</tr>";
                        }
                        $table .= "</tbody></table>";
                        echo $table;
                    }
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="therapists" role="tabpanel" aria-labelledby="therapists-tab">
            <div class="container pt-4">
                <div class="therapists-container container"></div>
            </div>
        </div>
        <div class="tab-pane fade" id="positions" role="tabpanel" aria-labelledby="positions-tab">
            <div class="container pt-4">
                <div class="positions-container container"></div>
            </div>
        </div>
        <div class="tab-pane fade" id="logic" role="tabpanel" aria-labelledby="logic-tab">
            <div class="container pt-4">
                <div class="logic-container container"></div>
            </div>
        </div>
    </div>
</div>