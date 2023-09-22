<?php
namespace App\Banque;

/**
 * compte avec taux d'interets
 */
class CompteEpargne extends Compte
{
    /**
     * Taux d'intérets du compte
     *
     * @var int
     */
    private $taux_interets;

    /**
     * Constructeur du compte épargne
     *
     * @param string $nom du titlaire
     * @param float $montant solde du compte
     * @param int $taux taux d'interets
     */
    public function __construct(string $nom, float $montant, int $taux)
    {
        //on transfere les info necessaires du constructeur de compte
        parent::__construct($nom, $montant);

        $this->taux_interets = $taux;
    }

    /**
     * getter
     *
     * @return int
     */
    public function getTauxInterets(): int
    {
        return $this->taux_interets;
    }

    /**
     * setter
     *
     * @param int $taux_interets
     * @return self
     */
    public function setTauxInterets(int $taux_interets): self
    {
        if($taux_interets >=0 ){
            $this->taux_interets = $taux_interets;
        }
        return $this;
    }

    public function verserInterets()
    {
        $this->solde = $this->solde + ($this->solde * $this->taux_interets / 100);
    }


   }