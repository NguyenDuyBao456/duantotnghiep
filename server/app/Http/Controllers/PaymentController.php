<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{
    public function zalopay(Request $request) {

        $config = [
            "appid" => 553,
            "key1" => "9phuAOYhan4urywHTh0ndEXiV3pKHr5Q",
            "key2" => "Iyz2habzyr7AG8SgvoBCbKwKi3UzlLi3",
            "endpoint" => "https://sandbox.zalopay.com.vn/v001/tpe/createorder"
        ];

        $embeddata = [
            "merchantinfo" => "embeddata123",
            "redirecturl" => "http://localhost:4200/thank?pay=zalopay"
        ];

        $items = [
            ["id" => "1"]
        ];

        $order = [
            "appid" => $config["appid"],
            "apptime" => round(microtime(true) * 1000), // miliseconds
            "apptransid" => date("ymd")."_".uniqid(), // mã giao dich có định dạng yyMMdd_xxxx
            "appuser" => "demo",
            "item" => json_encode($items, JSON_UNESCAPED_UNICODE),
            "embeddata" => json_encode($embeddata, JSON_UNESCAPED_UNICODE),
            "amount" => $request->amount,
            "description" => "ZaloPay Intergration Demo",
            "bankcode" => "",
        ];

        // appid|apptransid|appuser|amount|apptime|embeddata|item
        $data = $order["appid"]."|".$order["apptransid"]."|".$order["appuser"]."|".$order["amount"]
        ."|".$order["apptime"]."|".$order["embeddata"]."|".$order["item"];
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);

        $context = stream_context_create([
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($order)
            ]
        ]);

        $resp = file_get_contents($config["endpoint"], false, $context);

        if ($resp === false) {
            return response()->json(["error" => "Lỗi gọi API ZaloPay", "details" => error_get_last()], 500);
        }


        $result = json_decode($resp, true);
        return response()->json($result);
    }

    public function vnpay(Request $request) {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:4200/thank?pay=vnpay";
        $vnp_TmnCode = "Y66C5SE3"; // Mã website tại VNPAY
        $vnp_HashSecret = "HC87VSGDNPDK7TB5NEIXC5XM2VDXQ2TP"; // Chuỗi bí mật

        $vnp_TxnRef = time(); // Mã đơn hàng duy nhất
        $vnp_OrderInfo = "Noi dung thanh toan";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = intval($request->amount) * 100;
        $vnp_Locale = 'VN';
        $vnp_IpAddr = $request->ip();
        $vnp_BankCode="NCB";

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );


        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                    $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }


        return response()->json($vnp_Url);
    }

    public function momo(Request $request) {
        function execPostRequest($url, $data)
                {
                    $options = [
                        "http" => [
                            "header" => "Content-Type: application/json\r\n" .
                                        "Content-Length: " . strlen($data) . "\r\n",
                            "method"  => "POST",
                            "content" => $data,
                            "timeout" => 5 // Giới hạn thời gian chờ request
                        ]
                    ];

                    $context = stream_context_create($options);
                    $result = file_get_contents($url, false, $context);

                    return $result;
                }


                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $request->amount;
                $orderId = time() ."";
                $redirectUrl = "http://localhost/pay";
                $ipnUrl = "http://localhost/pay";
                $extraData = "";


                    $partnerCode = $partnerCode;
                    $accessKey = $accessKey;
                    $serectkey = $secretKey;
                    $orderId = $orderId; // Mã đơn hàng
                    $orderInfo = $orderInfo;
                    $amount = $amount;
                    $ipnUrl = $ipnUrl;
                    $redirectUrl = $redirectUrl;
                    $extraData = $extraData;

                    $requestId = time() . "";
                    $requestType = "payWithMethod";
                    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                    $extraData = $_POST["extraData"] ?? "";

                    //before sign HMAC SHA256 signature
                    $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
                    $signature = hash_hmac("sha256", $rawHash, $secretKey);

                    $data = array('partnerCode' => $partnerCode,
                        'partnerName' => "Test",
                        "storeId" => "MomoTestStore",
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'redirectUrl' => $redirectUrl,
                        'ipnUrl' => $ipnUrl,
                        'lang' => 'vi',
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature);
                    $result = execPostRequest($endpoint, json_encode($data));
                    $jsonResult = json_decode($result, true);  // decode json


                    //Just a example, please check more in there

                return response()->json($jsonResult['payUrl']);

    }



    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = "HC87VSGDNPDK7TB5NEIXC5XM2VDXQ2TP"; // Chuỗi bí mật
        $inputData = $request->all();



        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        unset($inputData['pay']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash('sha256', $vnp_HashSecret . $hashData);

        if ($secureHash == $vnp_SecureHash) {
            if($inputData['vnp_ResponseCode'] === "00") {
                return response()->json(['message' => "Gd thanh cong"]);
            } else {
                return response()->json(['message' => "Gd that bai"]);
            }
        } else {
            return response()->json(['message' => ' chu ky khong hop le']);
        }
    }

    public function zalopayReturn(Request $request) {


        $config = [
        "appid" => 553,
        "key1" => "9phuAOYhan4urywHTh0ndEXiV3pKHr5Q",
        "key2" => "Iyz2habzyr7AG8SgvoBCbKwKi3UzlLi3",
        "endpoint" => "https://sandbox.zalopay.com.vn/v001/tpe/getstatusbyapptransid"
        ];

        $apptransid = $request->apptransid;
        $data = $config["appid"]."|".$apptransid."|".$config["key1"]; // appid|apptransid|key1
        $params = [
        "appid" => $config["appid"],
        "apptransid" => $apptransid,
        "mac" => hash_hmac("sha256", $data, $config["key1"])
        ];

        $resp = file_get_contents($config["endpoint"]."?".http_build_query($params));
        $result = json_decode($resp, true);

        if (isset($result['return_code']) && $result['return_code'] == -217) {
            // \Log::error("ZaloPay Error: Thẻ ATM bị tạm dừng (Mã lỗi -217)");

            // Trả về thông báo lỗi và không redirect
            die();
        }

        return response()->json($result);
    }
}
