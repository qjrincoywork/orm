<div class="container default-tab pt-4">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">Email Extract</a>
        </li>
        <li class="nav-item">
            <a class="get_strmanipulation nav-link" id="strmanipulation-tab" data-toggle="tab" href="#strmanipulation" role="tab" aria-controls="strmanipulation" aria-selected="false">String Manipulation</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
            <div class="container pt-4">
                <form class="form-algo form-inline" method="POST" action="<?=URL;?>/Algorithm">
                    <div class="row">
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right text-secondary"><strong> Email </strong></label>
                            <input id="email" type="text" class="form-control form-control-sm" name="email" autofocus required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($data['result']))
                    {
                        echo "Sample: " . $data['sample'] . "<br>";
                        echo "Result: " . $data['result'];
                    }
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="strmanipulation" role="tabpanel" aria-labelledby="strmanipulation-tab">
            <div class="container pt-4">
                <div class="strmanipulation-container container"></div>
            </div>
        </div>
    </div>
</div>