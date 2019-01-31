<?php

namespace Aliyun\Core\Auth;
class EcsRamRoleCredential extends AbstractCredential
{
    private $roleName;

    public function __construct($roleName)
    {
        $this->roleName = $roleName;
    }

    public function getAccessKeyId()
    {
        return null;
    }

    public function getAccessSecret()
    {
        return null;
    }

    public function getRoleName()
    {
        return $this->roleName;
    }

    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

    public function getSecurityToken()
    {
        return null;
    }
}