<?php 
    class ModelExtensionModuleCustomelements extends Model{        
        public function SaveSettings() {
            $this->load->model('setting/setting');
            
            $settings = $this->request->post;
            
            
            foreach($settings['module_customelements_elements'] as $key => $e){
                
                
                if($e['name'] == "" && $e['imgurl'] == "" && $e['url'] == ""){                                        
                    unset($settings['module_customelements_elements'][$key]);
                }
            }
            
            $this->model_setting_setting->editSetting('module_customelements', $settings);
            
        }
        
       
        public function LoadSettings() {
            
            $data = array();
            $data['status'] = $this->config->get('module_customelements_status');
            $data['elements'] = $this->config->get('module_customelements_elements');
            $data['params'] = $this->config->get('module_customelements_params');
            return $data;
        }
    }
?>