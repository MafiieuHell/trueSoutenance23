<?php
namespace App\Banque;

/**
 * Compte bancaire (herite de compte).
 */
class CompteCourant extends Compte
{
    private $decouvert;

    /**
     * Constructeur du compte courant
     *
     * @param string $nom nom du titualaire
     * @param float $montant solde a l'ouverture
     * @param integer $decouvert découvert autorisé
     */
    public function __construct(string $nom, float $montant, int $decouvert)
    {
        //on transfere les info necessaires du constructeur de compte

        parent::__construct($nom, $montant);

        $this->decouvert = $decouvert;
    }

    public function getDecouvert():int
    {
        return $this->decouvert;
    }

    public function setDecouvert(int $decouvert): self
    {
        if($decouvert >= 0){
            $this->decouvert = $decouvert;
        }
        return $this;
    }

    public function retirer(float $montant)
    {
        //on verifie si le découvert permet le retrait 
        if($montant > 0 && $this->solde - $montant >= -$this->decouvert){
            $this->solde -= $montant;

        }else{
            echo "Solde insuffisant";
        }
    }
    

}