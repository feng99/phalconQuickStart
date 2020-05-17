<?php

namespace GeTui\Notification\Igetui\Reqs;

use GeTui\Notification\Protobuf\Type\PBEnum;

class ReqServListResult_ReqServHostResultCode extends PBEnum
{
    const successed  = 0;
    const failed  = 1;
    const busy  = 2;
}

?>