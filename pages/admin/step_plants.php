<?php
include('auth.php');
include('../../config/conectDB.php');

$date = date("d") . "/" . date("n") . "/" .  (date("Y") + 543);

?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>

<!-- datepicker thai -->
<script type="text/javascript" src="../../service/datepicker-thai/js/bootstrap-datepicker.js"></script>
<link href="../../service/datepicker-thai/css/datepicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../service/datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>



<body>
    <div class="dashboard-main-wrapper">
        <?php
        include('layout/header.php');
        include('layout/menu.php');
        ?>
        <div class="dashboard-wrapper">
            <div class="loading" id='loader'>Loading&#8230;</div>

            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3 class="text"><i class="fas fa-seedling"></i> ขั้นตอนการปลูกพืช</h3>
                        <hr>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-11 ml-3 mt-3">
                                    <div class="form-group">
                                        <select id="step" class="selectpicker show-tick" data-size="8" data-live-search="true" title="เลือกหมวดหมู่พืช" data-width="100%" required>
                                            <option value="all">ทั้งหมด</option>
                                            <?php
                                            $sql = "SELECT * FROM tb_plants_group";
                                            $result = mysqli_query($dbcon, $sql);
                                            if ($result->num_rows > 0) {
                                                while ($row  = mysqli_fetch_array($result)) {
                                                    echo '<option  value="' . $row['plantgroup_id'] . '">' . $row['name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 mt-3 mb-2">
                                <button class="btn btn-rounded btn-primary insert"><i class="fas fa-plus-circle"></i> เพิ่มขั้นตอนการปลูกพืช
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="step_plants">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="moda_delete" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-trash-alt"></i> คุณต้องการลบข้อมูล?</h3>
                                    <button type="button" class="close cls" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <h4 id="delName"></h4>
                                </div>
                                <div class="modal-footer">
                                    <a class="cls"> <button type="button" class="btn btn-rounded btn-primary" data-dismiss="modal">ยกเลิก</button></a>
                                    <button class="btn btn-rounded btn-danger " id="sub_delete">ตกลง</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form id="form" enctype="multipart/form-data">
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal_title"></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!-- parameter -->
                                    <input hidden type="text" name="action" id="action" value="">
                                    <input hidden type="text" name="id" id="id" value="">
                                    <input hidden type="text" name="eimg" id="eimg" value="">

                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="plantgroup" class="col-form-label">หมวดหมู่พืช</label>
                                                <select id="plantgroup" name="plantgroup" class="selectpicker show-tick" data-size="8" data-live-search="true" title="เลือกหมวดหมู่พืช" data-width="100%" required>
                                                    <?php
                                                    $sql = "SELECT * FROM tb_plants_group ";
                                                    $result = mysqli_query($dbcon, $sql);
                                                    $g = '';
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo '<option  value="' . $row['plantgroup_id'] . '">' . $row['name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label for="title" class="col-form-label">หัวข้อ</label>
                                                <input id="title" type="text" name="title" class="form-control" required>
                                                <div class="text-danger" id="messages">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="start_date">เริ่มต้น</label>
                                                <input data-date-language="th" class="form-control" id="start_date" name="start_date" value="<?php echo $date ?>">
                                            </div>
                                            <div class=" form-group col-md-6">
                                                <label for="end_date">สิ้นสุด</label>
                                                <input data-date-language="th" class="form-control" id="end_date" name="end_date" value="<?php echo $date ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">รายละเอียด</label>
                                            <textarea type="area" class="form-control" id="description" name="description" rows="4"></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="img" class="col-form-label">รูปภาพ</label>
                                                <input type="file" class="form-control" id="img" name="img">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <img src="" class="img-thumbnail rounded mx-auto d-block " id="show_img" width="250px" height="100%">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="cls"> <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">ยกเลิก</button></a>
                                            <button type="submit" class="btn btn-rounded btn-primary" id="btn">บันทึกข้อมูล</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                include('layout/footer.php');
                ?>
            </div>
        </div>
</body>

<script type="text/javascript">
    $('#show_img').attr('src', '../../images/plants/default.jpg');
    CKEDITOR.replace('description');
    var id, name, img;
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
    var d = new Date();
    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);


    $(".alert").fadeTo(3000, 0).slideUp(500, function() {
        $(this).remove();
    });

    $("#img").change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#show_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#step").on('change', function() {
        let id = $(this).val();
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                id: id
            },
            success: function(data) {
                $('#step_plants').html(data);
            }
        });
    });

    $('#start_date').datepicker({
        language: 'th-th',
        format: 'dd/mm/yyyy',
        autoclose: true

    });
    $('#end_date').datepicker({
        language: 'th-th',
        format: 'dd/mm/yyyy',
        autoclose: true

    });

    $('.insert').on('click', function() {
        $('#action').val('register');
        $('#title').html('<i class="fas fa-plus-circle"></i> ขั้นตอนการปลูกพืช');
        $('#modal').modal('show');
    });

    $("#form").on('submit', (function(e) {
        e.preventDefault();
        var dataForm = new FormData(this);
        dataForm.append('content', CKEDITOR.instances['description'].getData());
        $('#modal').modal('hide');
        loader.style.display = 'block';
        $.ajax({
            url: 'step_plants_db.php',
            data: dataForm,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                loader.style.display = 'none';
                let result = JSON.parse(res);
                if (result.status === 'success') {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: "ทำรายการสำเร็จ",
                        icon: 'success',
                        confirmButtonText: 'ปิด'
                    });
                    setTimeout(() => {
                        window.location.replace('step_plants.php');
                    }, 1500)
                }
                if (result.status === 'error' && result.messages === 'notUpload') {
                    $('#modal').modal('show');
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: "ไม่สามารถอัพโหลดรูปภาพ",
                        icon: 'error',
                        confirmButtonText: 'ปิด'
                    });
                }
                if (result.status === 'error' && result.messages === 'nameDuplicate') {
                    $('#modal').modal('show');
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: "ชื่อซ้ำกัน",
                        icon: 'error',
                        confirmButtonText: 'ปิด'
                    });
                    $('#messages').show();
                    $('#messages').text('**ชื่อซ้ำกัน***');
                }
            }
        });
    }));


    $(document).on('click', '.del', function(e) {
        id = $(this).attr('data-id');
        name = $(this).attr('data-name');
        img = $(this).attr('data-img');
        $('#delName').text(name);
        $('#moda_delete').modal('show');
    });

    $('#sub_delete').on('click', function() {
        $('#moda_delete').modal('hide');
        loader.style.display = 'block';
        $.ajax({
            url: 'step_plants_db.php',
            method: "post",
            data: {
                id: id,
                img: img,
                action: 'delete'
            },
            success: function(res) {
                loader.style.display = 'none';
                let result = JSON.parse(res);
                if (result.status === 'success') {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: "ทำรายการสำเร็จ",
                        icon: 'success',
                        confirmButtonText: 'ปิด'
                    });
                    setTimeout(() => {
                        window.location.replace('step_plants.php');
                    }, 1500)
                }
            }
        });
    });


    $(document).on('click', '.edit', function() {
        $('#action').val('update');
        $('#btn').html('อัพเดตข้อมูล');

        $('#modal_title').html('<i class="fas fa-redo-alt"></i> อัพเดตขั้นตอนการปลูกพืช');
        id = $(this).attr('data-id');
        $.ajax({
            url: "fetch_step_plants.php",
            method: "post",
            data: {
                id: id
            },
            success: function(data) {
                CKEDITOR.instances.description.setData(data);
            }
        });
        let plantgroup_id = $(this).attr('data-plantgroup_id');
        let title = $(this).attr('data-title');
        let start_date = convertDate($(this).attr('data-start_date'));
        let end_date = convertDate($(this).attr('data-end_date'));
        img = $(this).attr('data-img');
        if (img) {
            $('#eimg').val(img);
            $('#show_img').attr('src', '../../images/step_plants/' + img);
        } else {
            $('#show_img').attr('src', '../../images/plants/default.jpg');
        }
        $('#start_date').datepicker({
            date: start_date,
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        $('#end_date').datepicker({
            date: end_date,
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        $('#id').val(id);
        $('#title').val(title);
        $('#plantgroup').val(plantgroup_id).change();
        $('#modal').modal('show');
    });


    $('.cls').click(function() {
        $('#id').val('');
        $('#plantgroup').val('').change();
        $('#title').val('');
        $('#img').val('');
        $('#show_img').attr('src', '../../images/plants/default.jpg');
        CKEDITOR.instances.description.setData('');
        $('#eimg').val('');
    });

    function convertDate(dateString) {
        var p = dateString.split(/\D/g)
        return [p[2], p[1], p[0]].join("-")
    }
</script>