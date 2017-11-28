<p><a href="/users/add">新規作成</a></p>
<p><a href="/">戻る</a></p>
<p><a href="/usersPdf/index">ユーザー一覧PDF</a></p>
<p><a href="/usersExcel/index">ユーザー一覧Excel</a></p>
<table>
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>性別</th>
        <th>身分</th>
        <th>操作</th>
    </tr>
    
    <!--list-->
    <?php foreach ($duanusers as $users_item): ?>
        <tr>
            <td>
                <?php echo $users_item['id']; ?>
            </td>
            <td>
                <?php echo $users_item['name']; ?>
            </td>
            <td>
                <?php echo $users_item['gender']; ?>
            </td>
            <td>
                <?php echo $users_item['identity']; ?>
            </td>
            <td>
                <a href="/users/edit/id/<?= $users_item['id'] ?>/">編集</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>