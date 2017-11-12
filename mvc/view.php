<?= css('//cdn.datatables.net/1.10.12/css/jquery.dataTables.css') ?>
<?= css('//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.css') ?>
<?= js('//cdn.datatables.net/1.10.12/js/jquery.dataTables.js') ?>
<?= js('//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.js') ?>

<?php if(in_array(site()->user()->role(), c::get('logger.roles', ['admin']))): ?>
  <div class="bars cf">
    <div class="">
      <div class="section">
        <h2 class="hgroup hgroup-single-line hgroup-compressed cf"><span class="hgroup-title">Logger</span></h2>
        <table id="logger">
          <thead>
            <td><?= translation('user') ?></td>
            <td><?= translation('date') ?></td>
            <td><?= translation('action') ?></td>
            <td><?= translation('changes') ?></td>
          </thead>
          <tbody>

            <?php if(!empty($changes)):
              foreach($changes as $value): ?>
                <?php if(empty($value)) continue; ?>
                <?php $result = explode(',', $value);?>
                <tr>
                  <td><?= isset($result[0])? trim($result[0]):'' ?></td>
                  <td><?= isset($result[1])? trim($result[1]):'' ?></td>
                  <td><?= isset($result[2])? trim($result[2]):'' ?></td>
                  <td><?= isset($result[3])? str_replace('|', ", ", trim($result[3])):'' ?></td>
                </tr>
              <?php endforeach ?>
            <?php endif ?>

        </tbody>
        </table>
      </div>
    </div>
  </div>
<?php endif ?>

<script>
	$('#logger').on('init page.dt processing.dt order.dt draw.dt', function () {
    $('table.dataTable tr.odd').css('background-color', 'white');
    $('table.dataTable tr.even').css('background-color', '#efefef');
		$(".paginate_button").attr("href", "#");
		$(".paginate_button").bind('click', function (e) {
			e.preventDefault();
		});
	}).DataTable({
    "iDisplayLength": <?= c::get('logger.entries', 50); ?>,
		responsive: true,
		autoWidth: false,
    "bLengthChange": false,
    "columnDefs": [
    { "width": "40%", "targets": [3] }
    ]
	});
</script>
