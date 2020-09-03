<?php


namespace App\Service;


use ParagonIE\Halite\KeyFactory;
use ParagonIE\Halite\Symmetric\Crypto as Symmetric;
use ParagonIE\HiddenString\HiddenString;

/**
 *
 * https://github.com/paragonie/halite/blob/master/doc/Basic.md
 *
 */
class CrypterService
{
    /**
     * @var \ParagonIE\Halite\Symmetric\EncryptionKey
     */
    private $encryptionKey;
    /**
     * @var string
     */
    private $pathToKey;


    /**
     * CrypterService constructor.
     * @param string $pathToKey
     */
    public function __construct(string $pathToEncryptionKey)
    {
        $this->pathToKey = $pathToEncryptionKey;
    }

    public function generateEncryptionKey()
    {
        $encKey = KeyFactory::generateEncryptionKey();
        KeyFactory::save($encKey, $this->pathToKey);
    }

    public function getEncryptionKey()
    {
        if (!$this->encryptionKey) {
            $this->encryptionKey = KeyFactory::loadEncryptionKey($this->pathToKey);
        }
        return $this->encryptionKey;
    }

    public function encrypt(?string $value): ?string
    {
        $message = new HiddenString($value);
        $encrypted = Symmetric::encrypt($message, $this->getEncryptionKey());
        return $encrypted;
    }

    public function decrypt(?string $value): ?string
    {
        $decrypted = Symmetric::decrypt($value, $this->getEncryptionKey());
        return $decrypted->getString();
    }

}
