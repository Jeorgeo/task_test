<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      <th scope="col">Сумма</th>
      <th scope="col">Ответственный</th>
    </tr>
  </thead>
  <tbody>
    <?
    foreach ($arResult as $key => $item) {
    ?>
    <tr>
      <th scope="row"><?=$item['ID']?></th>
      <td><a href="<?=$item['LINK']?>" target="_blank">
          <?=$item['TITLE']?></td>
      </a>
      <td><?=$item['OPPORTUNITY']?></td>
      <td><?=$item['ASSIGNED_BY_NAME']?> <?=$item['ASSIGNED_BY_LAST_NAME']?></td>
    </tr>
    <?
    }
    ?>
  </tbody>
</table>
