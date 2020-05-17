<?php

namespace App\Sdks\Core\System\Plugins;

use Phalcon\Security;

/**
 * 安全加密插件
 *
 * 
 */
class CustomSecurity extends Security
{
    /**
     * 生成密码
     *
     * @param  mixed  $password
     * @return string
     */
    public function generatePassword($password)
    {
        return $this->hash(md5($password));
    }

    /**
     * 验证密码
     *
     * @param  string $password
     * @param  string $password_hash
     * @return bool
     */
    public function checkPassword($password, $password_hash)
    {
        return $this->checkHash(md5($password), $password_hash);
    }
}