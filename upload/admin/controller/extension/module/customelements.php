<?php
    class ControllerExtensionModuleCustomelements extends Controller{
        public function index() {
            $this->load->model('extension/module/customelements');
            if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
              $this->model_extension_module_customelements->SaveSettings();
              $this->session->data['success'] = 'Настройки сохранены';
              $this->response->redirect($this->url->link('extension/module/customelements', 'user_token=' . $this->session->data['user_token'] . $url, true));
            }
            $data = array();
            $settings = $this->model_extension_module_customelements->LoadSettings();
            $data['module_customelements_status'] = $settings['status'];
            $data['module_customelements_elements'] = $settings['elements'];
            $data['module_customelements_params'] = $settings['params'];
            
            $data += $this->load->language('extension/module/customelements');
            
            $data += $this->GetBreadCrumbs();
            $this->document->setTitle($this->language->get('heading_title'));
            
            $data['action'] = $this->url->link('extension/module/customelements', 'user_token=' . $this->session->data['user_token'], true);
            $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
            
            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->load->model('tool/image');
            $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            foreach($data['module_customelements_elements'] as &$element){
              $element['thumb'] = $this->model_tool_image->resize($element['imgurl'], 100, 100);              
            }            
            usort($data['module_customelements_elements'], function($a, $b){
                if ($a['sort_order'] == $b['sort_order']) {
                  return 0;
              }
              return ($a['sort_order'] < $b['sort_order']) ? -1 : 1;
            });            
            $this->response->setOutput($this->load->view('extension/module/customelements', $data));
         
          }
          private function GetBreadCrumbs() {
            $data = array(); $data['breadcrumbs'] = array();
            $data['breadcrumbs'][] = array(
              'text' => $this->language->get('text_home'),
              'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
            );
            $data['breadcrumbs'][] = array(
              'text' => $this->language->get('text_extension'),
              'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
            );
            $data['breadcrumbs'][] = array(
              'text' => $this->language->get('heading_title'),
              'href' => $this->url->link('extension/module/customelements', 'user_token=' . $this->session->data['user_token'], true)
            );
            return $data;
        }
    }

?>