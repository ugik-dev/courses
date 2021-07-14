<?php
$this->load->view('Fragment/HeaderFragment', ['title' => $title]);
?>
<style>
    .box-answer .btn {
        width: 18%;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">

        <form role="form" id="exam_form" onsubmit="return false;" type="multipart" autocomplete="off">
            <div class="row">
                <div class="col-lg-3">
                    <div class="alert alert-info" role="alert">
                        Timer <strong>

                            <div id="countdown"></div>
                        </strong>
                    </div>
                    <input type="hidden" value="<?= $token ?>" name="token">
                    <div class="ibox-content box-answer text-center nav" role="tablist">
                        <?= $btn ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="pills-tabContent">
                        <?php
                        $i = 0;
                        foreach ($data_soal as $ds) {
                            echo '<div class="tab-pane fade" id="soal_' . $i . '" role="tabpanel" aria-labelledby="pills-home-tab"><div class="ibox-content"><strong>' . ($i + 1) . '. ' . $ds['soal']['soal'] . $ans[$i] . '</strong>
                                <br><br>';
                            foreach ($ds['opsi'] as $ops) {
                                echo '<div class="form-check">
                                    <input class="form-check-input" type="radio" data-row="' . $i . '" name="row_' . $i . '" id="' . $ops['token_opsi'] . '" value="' . $ops['token_opsi'] . '" ' . ($ops['token_opsi'] == $ans[$i] ? 'checked' : '') . '>
                                    <label class="form-check-label" for="exampleRadios1">
                                    ' . $ops['name_opsi'] . '
                                    </label>
                                    </div>
                                    ';
                            }
                            echo '</div></div>';
                            $i++;
                        }
                        echo '<input type="hidden" value="' . $i . '" name="count">';
                        ?>
                        <input name="autosave" id="autosave" value="true">
                        <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..."><strong>Selesai</strong></button>

                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // set the date we're counting down to
        // variables for time units
        var days, hours, minutes, seconds;

        // get tag element
        var countdown = document.getElementById('countdown');

        // update the tag with id "countdown" every 1 second
        var seconds_left = <?= $timer ?>;
        var autosave = 0;
        setInterval(function() {
            autosave++;
            if (autosave > 3) {
                autosave = 0;
                autosave_f();
            }
            seconds_left = seconds_left - 1;
            minutes = parseInt(seconds_left / 60);
            // minutes = parseInt('<?= $timer ?>');
            seconds = parseInt(seconds_left % 60);

            // format countdown string + set tag value
            countdown.innerHTML = ' <span class="minutes">' +
                minutes + ' <label>Minutes</label></span> <span class="seconds">' + seconds + ' <label>Seconds</label></span>';

        }, 1000);

        var swalSaveConfigure = {
            title: "Konfirmasi Selesai",
            text: "Yakin akan mengakhiri ujian? ",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#18a689",
            confirmButtonText: "Ya!",
        };



        $('#exam_form input:radio').click(function() {
            var id = $(this).data('row');
            $('#ans_' + id).removeClass('btn-primary').addClass('btn-success')
            console.log(id)
        });
        var ExamForm = {
            'form': $('#exam_form')
        };
        ExamForm.form.submit(function() {
            swal(swalSaveConfigure).then((result) => {
                if (!result.value) {
                    return;
                }
                $('#autosave').val('false');
                event.preventDefault();
                return $.ajax({
                    url: `<?php echo site_url('PublicController/SubmitExam/') ?>`,
                    'type': 'POST',
                    data: ExamForm.form.serialize(),
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json['error']) {
                            return;
                        }
                        location.reload();
                    },
                    error: function(e) {}
                });
            })

        });

        function autosave_f() {
            // event.preventDefault();
            return $.ajax({
                url: `<?php echo site_url('PublicController/SubmitExam/') ?>`,
                'type': 'POST',
                data: ExamForm.form.serialize(),
            });
        }
    });
</script>
<?php $this->load->view('Fragment/FooterFragment');