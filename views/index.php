<?php if(site()->user()->role() == 'admin'): ?>
  <div class="bars cf">
    <div class="">
      <div class="section">
        <h2 class="hgroup hgroup-single-line hgroup-compressed cf"><span class="hgroup-title">Logger</span></h2>
        <table style="width: 100%">
          <thead>
            <td><?= translation('user') ?></td>
            <td><?= translation('date') ?></td>
            <td><?= translation('time') ?></td>
            <td><?= translation('action') ?></td>
          </thead>

          <?php if(!empty($changes)):
            foreach($changes as $value): ?>
              <?php $result = explode(',', $value); ?>
              <tr>
                <td>
                  <?= isset($result[0])? $result[0]:'' ?>
                </td>
                <td>
                  <?= isset($result[1])? $result[1]:'' ?>
                </td>
                <td>
                  <?= isset($result[2])? $result[2]:'' ?>
                </td>
                <td>
                  <?= isset($result[3])? $result[3]:'' ?>
                </td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </table>
      </div>
    </div>
  </div>
<?php endif ?>
