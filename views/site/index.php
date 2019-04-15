<div class="container">
    <div class="row">
        <a href="index.php?r=card/add" class="btn btn-outline-primary">Добавить</a>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Альбом</th>
                    <th scope="col">Исполнитель</th>
                    <th scope="col">Длительность</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата покупки</th>
                    <th scope="col">Код</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($cards as $value) {
                ?>
                    <tr>
                        <th scope="row">
                            <?='<img class="img-thumbnail" style="height:50px;" src="data:'
                                .$value['type'].';base64,'
                                .base64_encode($value['blob']).'"/>';?>
                        </th>
                        <td><?=$value['name']?></td>
                        <td><?=$value['artist']?></td>
                        <td><?=$value['duration']?></td>
                        <td><?=$value['price']?></td>
                        <td><?=$value['purchase_date']?></td>
                        <td><?=$value['code']?></td>
                        <td class="td-btn-right">
                            <button type="button" class="btn btn-outline-primary btn-sm">редактировать</button>
                            <button type="button" onclick="deleteCard(<?=$value['id']?>, this)" class="btn btn-outline-danger btn-sm">удалить</button>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function deleteCard(id, element) {
        if(confirm('Вы действительно хотите удалить?')) {
            fetch(`index.php?r=card/delete&id=${id}`)
            .then((response) => {
                return response.json();
            })
            .then(function(result) {
                if(result.res) {
                    element.parentNode.parentNode.remove();
                } else {
                    alert("Ошибка не удалось удалить запись");
                }
            });
        }
    }
</script>