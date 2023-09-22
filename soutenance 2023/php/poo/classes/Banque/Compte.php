<?php
namespace App\Banque;

/**
 * Objet compte bancaire
 */
abstract class Compte
{
    //Propriértés
    /**
     * Titulaire du compte
     *
     * @var string
     */
    private $titulaire;

    /**
     * Solde du compte
     *
     * @var float
     */
    protected $solde;

    /**
     * Constructeur du compt bancaire
     *
     * @param string $titulaire
     * @param integer $solde
     */
    public function __construct(string $titulaire, float $solde = 100)
    {
        //on attribue le titulaire a la propriéte titulaire 
        $this->titulaire = $titulaire;

        //on attribue le montant du compte a la propriéte solde
        $this->solde = $solde;
    }


    //accesseurs
    /**
     * getter de titulaire - retourn la valeur du titulire
     *
     * @return string
     */
    public function getTitulaire(): string
    {
        return $this->titulaire;
    }

    /**
     * modifie le nom du titulaire et retourne l'objet
     *
     * @param string $titulaire
     * @return Compte Compte bancaire
     */
    public function setTitulaire(string $titulaire): self
    {
        //on verifie si on a un titulaire
        if($titulaire != ''){
            $this->titulaire = $titulaire;
        }
        return $this;

    }

    /**
     * getter du solde - retourn la valeur du solde
     *
     * @return float
     */
    public function getSolde(): float
    {
        return $thid->solde;
    }

    /**
     * Modifie le solde du compte
     *
     * @param float $solde
     * @return Compte Compte bancaire
     */
    public function setSolde(float $solde):self
    {
        if($solde >= 0){
            $this->solde = $solde;
        }
        return $this;
    }




    /**
     * Déposer de l'argent sur le compte
     *
     * @param float $montant
     * @return void
     */
    public function deposer(float $montant) 
    {
        //on verifie si le montant et positif
        if($montant > 0){
            $this->solde +=$montant;
        }
    }

    /**
     * retourn le solde du compte
     *
     * @return void
     */
    public function voirSolde()
    {
        return "Le solde du compte est de $this->solde";
    }



 

    /**
     * Retirer un montant du solde
     *
     * @param float $montant
     * @return void
     */
    public function retirer(float $montant)
    {
        if($montant >0 && $this->solde >= $montant){
            $this->solde -= $montant;
        }else{
            echo"Montant insuffisant";
        }
    }
}