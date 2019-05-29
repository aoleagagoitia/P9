<h1>Gestionar categorías</h1>
<!--Este archivo es la vista del método index que tiene el controlador-->

<a href="<?= base_url ?>categoria/crear" class="button button-small">
    Crear categoría
</a>
<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php while ($cat = $categorias->fetch_object()): ?>
        <tr>
            <td><?= $cat->id; ?></td>
            <td><?= $cat->nombre; ?></td>
        </tr>
    <?php endwhile; ?>
</table>