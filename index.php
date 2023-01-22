<?php
function curl($param,$headers,$url)
{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_ENCODING, "GZIP,DEFLATE");
        //curl_setopt($ch,CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
return $result;
}


function cekRek($bank,$number)
    {
        $url = "https://cekrek.heirro.dev/api/check";
        $param = "accountBank=$bank&accountNumber=$number";
        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; RMX2061) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.186 Mobile Safari/537.36';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: */*';
        $headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
        return curl($param,$headers,$url);
    }
start:
system('cls');
        echo("
    =================================
    |       Check Name bank         |   Deskripsi : 
    | Github : Arimaulanafirmansyah |   • bca = Bank BCA            • ovo = OVO
    |          List Bank            |   • bni = Bank BNI            • dana = DANA
    | • dana    • gopay     • ovo   |   • bri = Bank BRI            
    | • mandiri • bca       • bri   |   • mandiri = Bank  Mandiri
    | • bni     • linkaja           |   • linkaja = Link Aja!
    |                               |   • gopay = GoPay
    =================================

");


echo "Input Bank : ";
$bank = trim(fgets(STDIN));
echo "Input Number Rekening : ";
$number = trim(fgets(STDIN));


echo "\n\nProses Cek Nama Bank!";
$register = cekRek($bank,$number);
$json = json_decode($register, true);
$status = $json['status'];
if ($status == 200) {
    $nama = $json['data'][0]['accountName'];
    echo "\n\nNama : $nama";
    } else {
        echo "\n\nError Silahkan Check Bank / Number ";
        goto start;
        }

?>