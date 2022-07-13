<%
use Cake\Utility\Inflector;

$fields = collection($fields)
  ->filter(function($field) use ($schema) {
    return !in_array($schema->getColumnType($field), ['binary', 'text']);
  })
  ->take(7);
%>

<!-- Page Heading -->
<!--h1 class="h3 mb-2 text-gray-800"><%= $pluralHumanName %></h1-->
<div class="h3 mb-2 text-gray-800"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>

<!--p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p-->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><%= $pluralHumanName %></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
<%  foreach ($fields as $field):
if (!in_array($field, ['created', 'modified', 'updated'])) :%>
                <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
<%  endif; %>
<%  endforeach; %>
                <th><?= __('Actions') ?></th>
              </tr>
                    <!--tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr-->
                </thead>
                <tfoot>
                <tr>
<%  foreach ($fields as $field):
if (!in_array($field, ['created', 'modified', 'updated'])) :%>
                <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
<%  endif; %>
<%  endforeach; %>
                <th><?= __('Actions') ?></th>
              </tr>
                </tfoot>
                <tbody>
                <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
              <tr>
<%  foreach ($fields as $field) {
    if (!in_array($field, ['created', 'modified', 'updated'])) {
    $isKey = false;
    if (!empty($associations['BelongsTo'])) {
    foreach ($associations['BelongsTo'] as $alias => $details) {
      if ($field === $details['foreignKey']) {
        $isKey = true;
%>
                <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
<%
          break;
        }
      }
    }

    if ($isKey !== true) {
      if (!in_array($schema->getColumnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
                <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
      } else {
%>
                <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
      }
    }
    }
  }
  $pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
    </div>
</div>
