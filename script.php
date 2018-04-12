<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$get = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

$coupon = strtoupper($get['q']);


CModule::Includemodule('catalog');
CModule::Includemodule('sale');

$date = new \Bitrix\Main\Type\DateTime();

if($coupon == true)
{
    if(CCatalogDiscountCoupon::IsExistCoupon($coupon))
    {
        $arCoupon = \Bitrix\Sale\Internals\DiscountCouponTable::getRow([
            'filter' => [
                'COUPON' => $coupon,
                'ACTIVE' => 'Y',
                '<=ACTIVE_FROM' => $date,
                '>=ACTIVE_TO' => $date,

            ]
        ]);
        if(!empty($arCoupon))
            echo 'ok';
    }

    $couponIterator = \Bitrix\Catalog\DiscountCouponTable::getList([
        'filter' => [
            'COUPON' => $coupon,
            'ACTIVE' => 'Y',
            '<=ACTIVE_FROM' => $date,
            '>=ACTIVE_TO' => $date,

        ]
    ]);
    if ($existCoupon = $couponIterator->fetch())
    {
        echo 'ok';
    }

}
?>
