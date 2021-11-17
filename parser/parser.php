<?php
 
/**
 * Classe parsant un fichier xml et affichant les informations sous la forme
 * d'une hierarchie de texte
 */
    class XmlParserExample1 {
        private $path;
        private $result;
        private $depth;

        public function __construct($path)
        {
            $this -> path = $path;
            $this -> depth = 0;
        }

        public function getResult() {
            return $this->result;
        }

        /**
         * Parse le fichier et met le resultat dans Result
         */
        public function parse()
        {
            ob_start();
            $xml_parser = xml_parser_create();
            xml_set_object($xml_parser, $this);
            xml_set_element_handler($xml_parser, "startElement", "endElement");
            xml_set_character_data_handler($xml_parser, 'characterData');
            if (!($fp = fopen($this -> path, "r"))) {
                die("could not open XML input");
            }

            while ($data = fread($fp, 4096)) {
                if (!xml_parse($xml_parser, $data, feof($fp))) {
                    die(sprintf("XML error: %s at line %d",
                                xml_error_string(xml_get_error_code($xml_parser)),
                                xml_get_current_line_number($xml_parser)));
                }
            }

            $this -> result = ob_get_contents();
            ob_end_clean();
            fclose($fp);
            xml_parser_free($xml_parser);
        }

        private function startElement($parser, $name, $attrs)
        {
            for ($i = 0; $i < $this -> depth; $i++) {
                echo "  ";
            }
            echo "<p style='color:red'> $name</p>\n";
            $this -> depth++;
            foreach($attrs as $attribute => $text)
            {
                $this ->displayAttribute($attribute, $text);
            }
        }

        private function displayAttribute($attribute, $text)
        {
            for ($i = 0; $i < $this -> depth; $i++) {
                echo "  ";
            }

            echo "A - $attribute = $text\n";
        }

        private function endElement($parser, $name)
        {
            $this -> depth--;
    echo "<p style='color:red'> $name</p>\n";

        }

        private function characterData($parser, $data)
        {
            $data = trim($data);

            if (strlen($data) > 0)
            {
                for ($i = 0; $i < $this -> depth; $i++) {
                    echo "  ";
                }

                echo 'T :'.$data."\n";
            }
        }
    }
?>