<?php
function order_dir_arrow($order, $order_dir)
{
    return $order == false ? '' : ($order_dir == 'desc' ? '↑' : '↓');
}

function order_dir($order, $order_dir)
{
    return $order == false ? 'asc' : ($order_dir == 'asc' ? 'desc' : 'asc');
}
