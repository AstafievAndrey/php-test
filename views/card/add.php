<div class="container">
    <form enctype="multipart/form-data" method="POST" action="index.php?r=card/save" class="needs-validation" novalidate>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label>Название альбома:</label>
                <input type="text" class="form-control" 
                    name="name"
                    placeholder="Название альбома" required>
                <div class="invalid-feedback">
                    Введите название альбома
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label>Испольнитель:</label>
                <select class="custom-select" name="artist_id" required >
                    <?php
                        foreach($artists as $value) {
                    ?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php
                        }
                    ?>
                </select>
                <div class="invalid-feedback">
                    Выберите исполнителя
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label>Код</label>
                <input type="text" class="form-control" placeholder="Код" 
                    name="code"
                    pattern="^[0-9]{2}:[0-9]{2}:[0-9]{2}$"
                    required>
                <div class="invalid-feedback">
                    Введите код по указанной маске: 00:00:00
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-2 mb-2">
                <label>Цена:</label>
                <input type="text" class="form-control" placeholder="Цена"
                    pattern="\d+(\.\d{2})?"
                    name="price"
                    required>
                <div class="invalid-feedback">
                    Укажите стоимость разделитель .
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <label>Длительность:</label>
                <input type="text" class="form-control" placeholder="Длительность"
                    pattern="^[0-9]+$"
                    name="duration"
                    required>
                <div class="invalid-feedback">
                    Укажите корректно длительность
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <label>Год выпуска:</label>
                <input type="text" name="year" class="form-control" placeholder="Год выпуска"
                    pattern="[0-9]{4}"
                    name="duration"
                    required>
                <div class="invalid-feedback">
                    Укажите год выпуска корректно
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>Дата покупки:</label>
                <input type="datetime-local" class="form-control" placeholder="Дата покупки"
                    name="purchase_date"
                    required>
                <div class="invalid-feedback">
                    Выберите дату
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-6">
                <label>Обложка:</label>
                <input type="file" 
                    accept="image/jpeg,image/png"
                    class="form-control-file"
                    name="image"
                    required>
                <div class="invalid-feedback">
                    Выберите обложку для альбома
                </div>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>

<script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>
</div>