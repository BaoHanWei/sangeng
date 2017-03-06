<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>编辑文档 - {{wiki_config('SITE_NAME','SmartWiki')}}</title>
    <link href="/Public/docs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/docs/editormd/css/editormd.min.css" rel="stylesheet">
    <link href="/Public/docs/jstree/themes/default/style.css" rel="stylesheet">
    <link href="/Public/docs/styles/wiki.css" rel="stylesheet">
    <link href="/Public/docs/styles/wikiedit.css" rel="stylesheet">
    <link href="/Public/docs/styles/markdown.css" rel="stylesheet">
    <script src="/Public/docs/scripts/jquery.min.js"></script>
    <script type="text/javascript">
        window.CONFIG = {
            "project_id" : "<?php echo ($project['id']); ?>"
        };
        window.treeCatalog = {};
    </script>
</head>
<body>
<div id="manual-edit">
    <div id="tree-root" style="width: 300px;">
        <div class="nav-item-left">
            <i class="fa fa-th-large"></i> 目录
        </div>
        <div class="nav-item-right">
            <button data-target="#create-new" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="create-document" title="创建文档">
                <i class="fa fa-plus"></i>
            </button>
        </div>
        <div class="nav-item-content" id="sidebar" style="height:100%;overflow: auto">

        </div>

    </div>
    <form method="post" action="<?php echo U('ucenter/document/save');?>" id="editormd-form">
        <div class="editormd-body">
            <div id="editormd">
                <input type="hidden" name="doc_id" id="document-id">
                <textarea style="display:none;">### Hello Editor.md !</textarea>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="create-wiki" tabindex="-1" role="dialog" aria-labelledby="添加文件" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="post" action="<?php echo U('ucenter/document/save');?>">
                <input type="hidden" name="project_id" value="<?php echo ($project["id"]); ?>">
                <input type="hidden" name="id" value="{<?php echo ($docs["id"]); ?>">
                <input type="hidden" name="parentId" value="<?php echo ($docs["parent_id"]); ?>">
                <input type="hidden" name="category" value="<?php echo ($project["category"]); ?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">添加文件</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="documentName" class="col-sm-2 control-label" id="inputTitle">名称</label>
                        <div class="col-sm-10">
                            <input type="text" name="documentName" class="form-control" id="documentName" placeholder="文档名称">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="error-message" style="color: #919191; font-size: 13px;"></span>
                    <button type="submit" class="btn btn-primary" id="btn-action" data-loading-text="提交中...">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="template-modal" tabindex="-1" role="dialog" aria-labelledby="请选择模板类型" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">请选择模板类型</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="section">
                        <a data-type="normal" href="javascript:;"><i class="fa fa-file-o"></i></a>
                        <h3><a data-type="normal" href="javascript:;">普通文档</a></h3>
                        <ul>
                            <li>默认类型</li>
                            <li>简单的文本文档</li>
                        </ul>
                    </div>
                    <div class="section">
                        <a data-type="api" href="javascript:;"><i class="fa fa-file-code-o"></i></a>
                        <h3><a data-type="normal" href="javascript:;">API文档</a></h3>
                        <ul>
                            <li>用于API文档速写</li>
                            <li>支持代码高亮</li>
                        </ul>
                    </div>
                    <div class="section">
                        <a data-type="code" href="javascript:;"><i class="fa fa-book"></i></a>

                        <h3><a data-type="code" href="javascript:;">数据字典</a></h3>
                        <ul>
                            <li>用于数据字典显示</li>
                            <li>表格支持</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<script type="text/plain" id="template-normal">
##SmartWiki是什么?
一个文档储存系统。

##SmartWiki有哪些功能？

-  项目管理
-  文档管理
-  用户管理
-  用户权限管理
-  项目加密
-  站点配置

##有问题反馈
在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

* 邮件(longfei6671#163.com, 把#换成@)
* QQ: 867311066
* http://www.iminho.me

##捐助开发者
在兴趣的驱动下,写一个`免费`的东西，有欣喜，也还有汗水，希望你喜欢我的作品，同时也能支持一下。
当然，有钱捧个钱场（右上角的爱心标志，支持支付宝捐助），没钱捧个人场，谢谢各位。

##感激
感谢以下的项目,排名不分先后

- laravel 5.2
- mysql 5.6
- editor.md
- bootstrap 3.2
- jquery 库
- layer 弹出层框架
- webuploader 文件上传框架
- Nprogress 库
- jstree
- font awesome 字体库
- cropper 图片剪裁库

##关于作者

一个纯粹的PHPer.
PS：PHP是世界上最好的语言，没有之一(逃
</script>
<script type="text/plain" id="template-api">
### 简要描述：

- 用户登录接口

### 请求域名:

- http://xx.com

### 请求URL:

GET:/api/login

POST:/api/login

PUT:/api/login

DELETE:/api/login

TRACE:/api/login


### 参数:

|参数名|是否必须|类型|说明|
|:----    |:---|:----- |-----   |
|username |是  |string |用户名   |
|password |是  |string | 密码    |

### 返回示例:

**正确时返回:**

```
  {
    "errcode": 0,
    "data": {
      "uid": "1",
      "account": "admin",
      "nickname": "Minho",
      "group_level": 0 ,
      "create_time": "1436864169",
      "last_login_time": "0",
    }
  }
```

**错误时返回:**


```
  {
    "errcode": 500,
    "errmsg": "invalid appid"
  }
```

### 返回参数说明:

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|group_level |int   |用户组id，1：超级管理员；2：普通用户  |

### 备注:

- 更多返回错误代码请看首页的错误代码描述



</script>
<script type="text/plain" id="template-code">
### 数据库字典
#### 用户表，储存用户信息

|字段|类型|空|默认|注释|
|:----    |:-------    |:--- |-- -|------      |
|uid	  |int(10)     |否	|	 |	           |
|username |varchar(20) |否	|    |	 用户名	|
|password |varchar(50) |否   |    |	 密码		 |
|name     |varchar(15) |是   |    |    昵称     |
|reg_time |int(11)     |否   | 0  |   注册时间  |

#### 备注：无



</script>
<script src="/Public/docs/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/docs/jstree/jstree.js"></script>
<script type="text/javascript" src="/Public/docs/scripts/jquery.form.js"></script>
<script type="text/javascript" src="/Public/docs/layer/layer.js"></script>
<script type="text/javascript" src="/Public/docs/scripts/json2.js"></script>
<script type="text/javascript" src="/Public/docs/editormd/editormd.js"></script>
<script type="text/javascript">
    /**
     * 初始化jstree
     */
    function initJsTree() {
        $("#sidebar").jstree({
            'plugins': [ "wholerow", "types", 'dnd', 'contextmenu'],
            "types": {
                "default": {
                    "icon": false  // 删除默认图标
                }
            },
            'core': {
                'check_callback': true,
                'data': <?php echo ($json); ?>,
                'animation': 0,
                "multiple": false
            },
            "contextmenu": {
                show_at_node: false,
                select_node: false,
                "items": {
                    "添加文档": {
                        "separator_before": false,
                        "separator_after": true,
                        "_disabled": false,
                        "label": "添加文档",
                        "icon": "fa fa-plus",
                        "action": function (data) {
                            var inst = $.jstree.reference(data.reference),
                                node = inst.get_node(data.reference);
                            openCreateCatalogDialog(node);
                        }
                    },
                    "编辑": {
                        "separator_before": false,
                        "separator_after": true,
                        "_disabled": false,
                        "label": "编辑",
                        "icon": "fa fa-edit",
                        "action": function (data) {
                            var inst = $.jstree.reference(data.reference);
                            var node = inst.get_node(data.reference);
                            editDocumentDialog(node);
                        }
                    },
                    "删除": {
                        "separator_before": false,
                        "separator_after": true,
                        "_disabled": false,
                        "label": "删除",
                        "icon": "fa fa-trash-o",
                        "action": function (data) {
                            var inst = $.jstree.reference(data.reference);
                            var node = inst.get_node(data.reference);
                            deleteDocumentDialog(node);
                        }
                    }
                }
            }
        }).on('loaded.jstree', function () {
            window.treeCatalog = $(this).jstree();
            $select_node_id = window.treeCatalog.get_selected();
            if($select_node_id) {
                $select_node = window.treeCatalog.get_node($select_node_id[0])
                if ($select_node) {
                    $select_node.node = {
                        id: $select_node.id
                    };

                    window.loadDocument($select_node);
                }
                console.log($select_node);
            }

        }).on('select_node.jstree', function (node, selected, event) {
             window.loadDocument(selected);

        }).on("move_node.jstree", function (node, parent) {

            var parentNode = window.treeCatalog.get_node(parent.parent);

            var nodeData = window.getSiblingSort(parentNode);

            if (parent.parent != parent.old_parent) {
                parentNode = window.treeCatalog.get_node(parent.old_parent);
                //console.log(parentNode);
                var newNodeData = window.getSiblingSort(parentNode);
                if (newNodeData.length > 0) {
                    nodeData = nodeData.concat(newNodeData);
                }
            }

            var index = layer.load(1, {
                shade: [0.1, '#fff'] //0.1透明度的白色背景
            });
            $.post("<?php echo U('ucenter/document/sort',array('id'=>$project['id']));?>", JSON.stringify(nodeData)).done(function (res) {
                layer.close(index);
                if (res.errcode != 0) {
                    layer.msg(res.message);
                } else {
                    layer.msg("保存排序成功");
                }
            }).fail(function () {
                layer.close(index);
                layer.msg("保存排序失败");
            });
        });
    }
    $(function () {

        $("#template-modal .section>a").on("click",function () {
            var type = $(this).attr('data-type');
            if(type){
                var template = $("#template-" + type).text();
                window.editor.insertValue(template);
            }
            $("#template-modal").modal('hide');
        });
    });
</script>
<script type="text/javascript" src="/Public/docs/scripts/wiki.js"></script>
</body>
</html>