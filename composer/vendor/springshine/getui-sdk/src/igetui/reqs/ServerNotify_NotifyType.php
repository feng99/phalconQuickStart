<?php

namespace GeTui\Notification\Igetui\Reqs;

use GeTui\Notification\Protobuf\Type\PBEnum;

class ServerNotify_NotifyType extends PBEnum
{
    const normal  = 0;
    const serverListChanged  = 1;
    const exception  = 2;
}
?>