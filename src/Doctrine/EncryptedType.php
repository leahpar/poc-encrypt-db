<?php


namespace App\Doctrine;


use App\Service\CrypterService;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class EncryptedType extends Type
{

    const TYPE = 'encrypted';
    /**
     * @var CrypterService
     */
    private $crypter;

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        // varchar(length)
        return $platform->getVarcharTypeDeclarationSQL($column);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // This is executed when the value is read from the database. Make your conversions here, optionally using the $platform.
        return $this->getCrypter($platform)->decrypt($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // This is executed when the value is written to the database. Make your conversions here, optionally using the $platform.
        return $this->getCrypter($platform)->encrypt($value);
    }

    /**
     * Petit hack pour pouvoir utiliser l'injection de dépendance :
     *  on passer le service en tant que listener...
     */
    private function getCrypter(AbstractPlatform $platform): CrypterService
    {
        if (!$this->crypter) {
            /** @var array $listCrypterListener */
            $listCrypterListener = $platform->getEventManager()->getListeners('crypter');
            /** @var CrypterService $crypterListener */
            $crypterListener = array_shift($listCrypterListener);

            $this->crypter = $crypterListener;
        }

        return $this->crypter;
    }

}

