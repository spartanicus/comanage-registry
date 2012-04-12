<!--
/**
 * COmanage Registry CO Petition Index View
 *
 * Copyright (C) 2012 University Corporation for Advanced Internet Development, Inc.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software distributed under
 * the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 *
 * @copyright     Copyright (C) 2012 University Corporation for Advanced Internet Development, Inc.
 * @link          http://www.internet2.edu/comanage COmanage Project
 * @package       registry
 * @since         COmanage Registry v0.5
 * @license       Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version       $Id$
 */
-->
<h1 class="ui-state-default"><?php echo $cur_co['Co']['name']; ?> People</h1>

<?php
  if($permissions['add']) {
    print $this->Html->link(_txt('op.enroll'),
                            array('controller' => 'co_enrollment_flows', 'action' => 'select', 'co' => $cur_co['Co']['id']),
                            array('class' => 'addbutton')) . '
    <br />
    <br />
    ';    
  }
  
//  debug($co_petitions);
?>
 
<table id="co_people" class="ui-widget">
  <thead>
    <tr class="ui-widget-header">
      <th><?php echo $this->Paginator->sort('EnrolleeCoPerson.Name.family', _txt('fd.enrollee')); ?></th>
      <th><?php echo $this->Paginator->sort('PetitionerCoPerson.Name.family', _txt('fd.petitioner')); ?></th>
      <th><?php echo $this->Paginator->sort('SponsorCoPerson.Name.family', _txt('fd.sponsor')); ?></th>
      <th><?php echo $this->Paginator->sort('ApproverCoPerson.Name.family', _txt('fd.approver')); ?></th>
      <th><?php echo $this->Paginator->sort('status', _txt('fd.status')); ?></th>
      <th><?php echo $this->Paginator->sort('created', _txt('fd.created')); ?></th>
      <th><?php echo $this->Paginator->sort('modified', _txt('fd.modified')); ?></th>
      <th><?php echo _txt('fd.actions'); ?></th>
    </tr>
  </thead>
  
  <tbody>
    <?php $i = 0; ?>
    <?php foreach ($co_petitions as $p): ?>
    <tr class="line<?php print ($i % 2)+1; ?>">
      <td>
        <?php
          print $this->Html->link(generateCn($p['EnrolleeCoPerson']['Name']),
                                  array(
                                    'controller' => 'co_petitions',
                                    'action' => ($permissions['edit']
                                                 ? 'view'
                                                 : ($permissions['view'] ? 'view' : '')),
                                    $p['CoPetition']['id'],
                                    'co' => $p['CoPetition']['co_id'],
                                    'coef' => $p['CoPetition']['co_enrollment_flow_id'])
                                  );
        ?>
      </td>
      <td>
        <?php
          if(isset($p['PetitionerCoPerson']['id']) && $p['PetitionerCoPerson']['id'] != '') {
            print $this->Html->link(generateCn($p['PetitionerCoPerson']['Name']),
                                    array(
                                      'controller' => 'co_people',
                                      'action' => 'view',
                                      $p['PetitionerCoPerson']['id'],
                                      'co' => $p['CoPetition']['co_id'])
                                    );
          }
        ?>
      </td>
      <td>
        <?php
          if(isset($p['SponsorCoPerson']['id']) && $p['SponsorCoPerson']['id'] != '') {
            print $this->Html->link(generateCn($p['SponsorCoPerson']['Name']),
                                    array(
                                      'controller' => 'co_people',
                                      'action' => 'view',
                                      $p['SponsorCoPerson']['id'],
                                      'co' => $p['CoPetition']['co_id'])
                                    );
          }
        ?>
      </td>
      <td>
        <?php
          if(isset($p['ApproverCoPerson']['id']) && $p['ApproverCoPerson']['id'] != '') {
            print $this->Html->link(generateCn($p['ApproverCoPerson']['Name']),
                                    array(
                                      'controller' => 'co_people',
                                      'action' => 'view',
                                      $p['ApproverCoPerson']['id'],
                                      'co' => $p['CoPetition']['co_id'])
                                    );
          }
        ?>
      </td>
      <td>
        <?php
          global $status_t;
          
          if(!empty($p['EnrolleeCoPerson']['status'])) {
            print _txt('en.status', null, $p['EnrolleeCoPerson']['status']);
          }
        ?>
      </td>
      <td>
        <?php
          if(!empty($p['EnrolleeCoPerson']['created'])) {
            print $this->Time->niceShort($p['EnrolleeCoPerson']['created']);
          }
        ?>
      </td>
      <td>
        <?php
          if(!empty($p['EnrolleeCoPerson']['modified'])) {
            print $this->Time->niceShort($p['EnrolleeCoPerson']['modified']);
          }
        ?>
      </td>
      <td>
        <?php
          if($permissions['edit']) {
            print $this->Html->link(_txt('op.view'),
                                    array('controller' => 'co_petitions',
                                          'action' => 'view',
                                          $p['CoPetition']['id'],
                                          'co' => $cur_co['Co']['id'],
                                          'coef' => $p['CoPetition']['co_enrollment_flow_id']),
                                    array('class' => 'editbutton')) . "\n";
          }
        ?>
        <?php ; ?>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; // $co_people ?>
  </tbody>
  
  <tfoot>
    <tr class="ui-widget-header">
      <th colspan="8">
        <?php echo $this->Paginator->numbers(); ?>
      </td>
    </tr>
  </tfoot>
</table>