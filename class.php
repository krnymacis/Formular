<?php

class formular {
    
    /**
     * Uchovává cestu k souboru na který formulář volá.
     * @var string 
     */
    private $action;
    
    /**
     * Zde se ukládá metoda jakou se bude formulář odesílat.
     * @var string 
     */
    private $method;
    
    /**
     * Slouží pro uložení jména vstupu pro identifikaci vstupu.
     * @var string 
     */
    private $name;
    
    /**
     * Zde se ukládají všechny inforvamce do vybraných vstupů.
     * @var array 
     */
    private $data = array();
    
    /**
     * Uchovává číslo pro identifikaci kolikátý vstup jsme vytvořily.
     * @var inteeger 
     */
    private $id;

    /**
     * konstruktor třídy
     * @param string $action Zadejte soubor na který bude formulář volat.
     * @param string $method Zadejte metodu odesílání dat formuláře. (get, post)
     * @param string $name Zadejte název který se ukáže jako nadpist formuláře.
     */
    function __construct($action, $method, $name) {
        $this->action = $action;
        $this->method = $method;
        $this->name = $name;
        $this->id = 0;
    }

    /**
     * Slouží pro vložení vstupu.
     * @param string $type Zde zadejte typ vstupu. (text, password, radio, checkbox,  submit, file) 
     * @param string $name Zadejte název vstupu pro identifikaci.
     * @param string $label Zadejte název vstupu. (Zobrazí se jako label.)
     */
    function input($type, $name, $label) {
        $this->data[$this->id]["co"] = "input";
        $this->data[$this->id]["data"] = array($type, $name, $label);
        $this->id = $this->id + 1;
    }

    /**
     * Slouží pro vložení selectu.
     * @param string $name Zadejte název vstupu pro identifikaci.
     * @param array $list Zadejte do pole hodnoty které bude možné v selectu vybírat.
     * @param string $label Zadejte název vstupu. (Zobrazí se jako label.)
     */
    function select($name, $list, $label) {
        $this->data[$this->id]["co"] = "select";
        $this->data[$this->id]["data"] = array($list, $name, $label);
        $this->id = $this->id + 1;
    }

    /**
     * Slouží pro vložení textového pole
     * @param string $name Zadejte název vstupu pro identifikaci.
     * @param string $label Zadejte název vstupu. (Zobrazí se jako label.)
     */
    function textarea($name, $label) {
        $this->data[$this->id]["co"] = "textarea";
        $this->data[$this->id]["data"] = array($name, $label);
        $this->id = $this->id + 1;
    }

    /**
     * Magická metoda sloužící pro vygenerování výsledného formuláře.
     * @return string Vrací vypsaný formulář v HTML.
     */
    function __toString() {
        $vratit = '<form action="'.$this->action.'" method="'.$this->method.'">';
        $vratit .= '<fieldset>';
        $vratit .= '<legend>'.$this->name.'</legend>';
        foreach ($this->data as $key => $value) {
            if ($value["co"] == "input") {
                $vratit .= '<label for="'.$value["data"][1].'">'.$value["data"][2].'</label>';
                $vratit .= '<input type="'.$value["data"][0].'" name="'.$value["data"][1].'">';
                $vratit .= '';
            } elseif ($value["co"] == "select") {
                $vratit .= '<label for="'.$value["data"][1].'">'.$value["data"][2].'</label>';
                $vratit .= '<select name="'.$value["data"][1].'">';
                foreach ($value["data"][0] as $valuenx) {
                    $vratit .= '<option value="'.$valuenx.'">'.$valuenx.'</option>';
                }
                $vratit .= '</select>';
            } elseif ($value["co"] == "textarea") {
                $vratit .= '<label for="'.$value["data"][0].'">'.$value["data"][1].'</label>';
                $vratit .= '<textarea name="'.$value["data"][0].'"></textarea>';
                $vratit .= '';
            }
            $vratit .= '<br>';
        }
        $vratit .= '<br>';
        $vratit .= '<input type="submit" value="odeslat">';
        $vratit .= '</fieldset>';
        $vratit .= '</form>';
        return $vratit;
    }

}
