<%
use Cake\Utility\Inflector;

   $extras = [];
%>



<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!--div class="col-lg-5 d-none d-lg-block bg-register-image"></div-->
          <div class="col-lg-3 d-none d-lg-block"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">
                    <%= $singularHumanName %>
                    <small><?= __('<%= Inflector::humanize($action) %>') ?></small>
                </h1>
              </div>
              <?= $this->Form->create($<%= $singularVar %>, array('role' => 'form',"class" => "user")) ?>
          <div class="box-body">
          <?php
<%
    foreach ($fields as $field) {
      if (in_array($field, $primaryKey)) {
        continue;
      }
      if (isset($keyFields[$field])) {
        $fieldData = $schema->getColumn($field);
        if (!empty($fieldData['null'])) {
%>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => true, "class" => "form-control"]);
<%
        } else {
%>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, "class" => "form-control"]);
<%
        }
        continue;
      }
      if (!in_array($field, ['created', 'modified', 'updated'])) {
        $fieldData = $schema->getColumn($field);
        if (($fieldData['type'] === 'date')) {
            $extras[] = 'datepicker';
%>
            echo $this->Form->input('<%= $field %>', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
<%
        } else {
%>
            echo $this->Form->input('<%= $field %>',[ "class" => "form-control"]);
<%
        }
      }
    }
    if (!empty($associations['BelongsToMany'])) {
      foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
%>
            echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
<%
      }
    }
%>
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer pt-4">
            <?= $this->Form->button('<i class="fas fa-check"></i> '.__('Save'),["class" => "btn btn-success"]) ?>
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> '.__('Back'), ['action' => 'index'], ['escape' => false,"class" => "btn btn-primary"]) ?>
          </div>
        <?= $this->Form->end() ?>



              
          </div>
        </div>
      </div>
    </div>

  </div>




<%
    if (!empty($extras)) {
        foreach($extras as $element) {
        %>
        <% echo $this->element($element); %>
        <%
        }
    }
%>