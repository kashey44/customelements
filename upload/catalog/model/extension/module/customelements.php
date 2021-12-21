<?php
    class ModelExtensionModuleCustomelements extends Model{        
        public function LoadSettings() {        
            $data = array();
            $data['status'] = $this->config->get('module_customelements_status');
            $data['elements'] = $this->config->get('module_customelements_elements');
            $data['params'] = $this->config->get('module_customelements_params');
            return $data;
        }
    }
?>