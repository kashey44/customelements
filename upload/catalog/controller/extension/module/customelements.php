<?php
    class ControllerExtensionModuleCustomelements extends Controller{
        public function index() {            
            $this->load->model('extension/module/customelements');
            $this->load->model('tool/image');
            $settings = $this->model_extension_module_customelements->LoadSettings();
            
            $data['module_customelements_status'] = $settings['status'];
            $data['module_customelements_elements'] = $settings['elements'];
            $data['module_customelements_params'] = $settings['params'];
            
            $data += $this->load->language('extension/module/customelements');
            foreach($data['module_customelements_elements'] as &$element){
               
                $element['imgurl'] = $this->model_tool_image->resize($element['imgurl'], $settings['params']['width'], $settings['params']['height']);
            }
            usort($data['module_customelements_elements'], function($a, $b){
                if ($a == $b) {
                  return 0;
              }
              return ($a < $b) ? -1 : 1;
            });
            
            
            return $this->load->view('extension/module/customelements', $data);
          }
    }

?>