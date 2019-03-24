<?php
    function pw_hash($pw){
        $md5 = md5($pw);
        $m = array();
        $k = array();
        $digit = 36;        // 目標進位值
        $offset_1 = 11;     // 偏移量（Key 乘）
        $offset_2 = 1777;   // 偏移量（Key 加）
        $offset_3 = 3571;   // 偏移量（區塊倍率）
        for($i=0; $i<16; $i++){
            $m[$i] = hexdec(substr($md5, $i*2, 2));
            if($i % 2 == 1){
                $k[($i-1)/2] = (($m[$i]*$m[$i-1]) * $offset_1 + $offset_2) % ($digit ** 2);
                $m[$i] = ($m[$i] * $offset_3) % ($digit ** 2);
                $m[$i] = $m[$i] ^ $k[($i-1)/2];
                $m[$i-1] = $m[$i-1] ^ $k[($i-1)/2];
            }
        }
        $hash = '';
        for($i=0; $i<16; $i++){
            $hash = $hash.base_convert($m[$i], 10, $digit);
        }
        return $hash;
    }
?>