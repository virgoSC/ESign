<?php

namespace ESign\District;

class OneStepConfig
{

    /**
     * 附件信息
     * @var array $attachments
     */
    private $attachments;

    /**
     *抄送人人列表
     * @var array $copiers
     */
    private $copiers;

    /**
     * 待签署文件信息
     * @var array $docs
     */
    private $docs;

    /**
     * 本次签署流程的任务信息配置
     * @var array $flowConfigInfo
     */
    private $flowConfigInfo = [];

    /**
     * 本次签署流程的基本信息
     * @var array
     */
    private $flowInfo;

    /**
     * 本次签署流程添加的签署区的列表信息
     * @var array
     */
    private $signers;

    /**
     * @return array
     */
    public function generate(): array
    {

        $request = [
            'docs' => $this->docs,
            'flowInfo' => $this->flowInfo,
            'signers' => $this->signers
        ];

        if ($this->attachments) {
            $request['attachments'] = $this->attachments;
        }

        if ($this->copiers) {
            $request['copiers'] = $this->copiers;
        }

        if ($this->flowConfigInfo) {
            $request['flowInfo']['flowConfigInfo'] = $this->flowConfigInfo;
        }

        return $request;
    }

    /**
     * 添加附件信息
     * @param string $fileId
     * @param string $attachmentName
     * @return $this
     */
    public function attachments(string $fileId, string $attachmentName): self
    {
        $this->attachments[] = [
            'fileId' => $fileId,
            'attachmentName' => $attachmentName
        ];
        return $this;
    }

    /**
     * 添加抄送人
     * @param string $copierAccountId
     * @param int $copierIdentityAccountType
     * @param string $copierIdentityAccountId
     * @return $this
     */
    public function copiers(string $copierAccountId, int $copierIdentityAccountType = 0, string $copierIdentityAccountId = ''): self
    {
        $copier = [
            'copierAccountId' => $copierAccountId,
            'copierIdentityAccountType' => $copierIdentityAccountType,
        ];
        if ($copierAccountId) {
            $copier['copierIdentityAccountId'] = $copierAccountId;
        }
        $this->copiers[] = $copier;
        return $this;
    }

    /**
     *待签署文件信息
     * @param string $fileId
     * @param string $fileName
     * @param string $encryption
     * @param string $filePassword
     * @return $this
     */
    public function docs(string $fileId, string $fileName = '', string $encryption = '0', string $filePassword = ''): self
    {
        $docs = [
            'fileId' => $fileId
        ];

        if ($fileName) {
            $docs['fileName'] = $fileName;
        }
        if ($encryption) {
            $docs['encryption'] = $encryption;
        }
        if ($filePassword) {
            $docs['filePassword'] = $filePassword;
        }
        $this->docs[] = $docs;
        return $this;
    }

    /**
     * 本次签署流程的任务信息配置
     * @param array $array
     */
    public function flowConfigInfo(array $array = [])
    {
        $this->flowConfigInfo = $array;
    }

    /**
     * 本次签署流程的基本信息
     * @param string $businessScene
     * @param bool $autoArchive
     * @param bool $autoInitiate
     * @param int $signValidity
     * @param int $contractValidity
     * @param int $contractRemind
     * @param string|null $initiatorAccountId
     * @param string|null $initiatorAuthorizedAccountId
     * @return $this
     */
    public function flowInfo(string $businessScene, bool $autoArchive = false, bool $autoInitiate = false, int $signValidity = 0, int $contractValidity = 0, int $contractRemind = 0, string $initiatorAccountId = null, string $initiatorAuthorizedAccountId = null): OneStepConfig
    {
        $this->flowInfo['businessScene'] = $businessScene;
        $this->flowInfo['autoArchive'] = $autoArchive;
        $this->flowInfo['autoInitiate'] = $autoInitiate;

        if ($signValidity) {
            $this->flowInfo['signValidity'] = $signValidity;
        }

        if ($contractValidity) {
            $this->flowInfo['contractValidity'] = $contractValidity;
        }

        if ($contractRemind) {
            $this->flowInfo['contractRemind'] = $contractRemind;
        }

        if ($initiatorAccountId) {
            $this->flowInfo['initiatorAccountId'] = $initiatorAccountId;
        }
        if ($initiatorAuthorizedAccountId) {
            $this->flowInfo['initiatorAuthorizedAccountId'] = $initiatorAuthorizedAccountId;
        }

        return $this;
    }

    /**
     * 本次签署流程添加的签署区的列表信息
     * @param array $signFields
     * @param bool|null $platformSign
     * @param int|null $signOrder
     * @param array $signerAccount
     * @return $this
     */
    public function signers(array $signFields,array $signerAccount = [], bool $platformSign = null, int $signOrder = null): OneStepConfig
    {

        $signers = [
            'signfields' => $signFields
        ];

        if ($platformSign) {
            $signers['platformSign'] = $platformSign;
        }

        if ($signOrder) {
            $signers['signOrder'] = $signOrder;
        }

        if ($signerAccount) {
            $signers['signerAccount'] = $signerAccount;
        }

        $this->signers[] = $signers;

        return $this;
    }

}
