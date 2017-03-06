<?php
/**
 * Created by PhpStorm.
 * User: 牛粑粑
 * Date: 4/4/14
 * Time: 9:29 AM
 */

namespace Api\Controller;

class GroupController extends BaseController
{
    //返回寺院分类信息
    public function getGroupType()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aId = I_POST('id', 'intval');
        $GroupModel = D('Api/Group');
        if ($aId) {
            $Group = D('Group/GroupType')->where(array('status' => 1, 'pid' => $aId))->page($aPage, 10)->order('create_time asc')->find();
            if (!$Group) {
                $this->apiError('没有此寺院');
            }
        } else {
            $Group = D('Group/GroupType')->getList(array('field' => 'id', 'where' => array('status' => 1, 'pid' => 0), 'page' => $aPage, 'order' => 'create_time asc'));
            foreach ($Group as &$g) {
                $g = $GroupModel->getGroupType($g);
            }
            unset($g);
        }
        if (!$Group) {
            $this->apiError('寺院分类返回失败！');
        } else {
            $this->apiSuccess('返回成功', $Group);
        }

    }

    //返回所有寺院信息
    public function getGroupAll()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aTypeId = I_POST('type_id', 'intval');
        $map['status'] = 1;
        $aTypeId && $map['type_id'] = $aTypeId;
        $GroupModel = D('Api/Group');

        if (empty($aTypeId)) {
            $Groups = D('Group/Group')->getList(array('field' => 'id', 'where' => array('status' => 1), 'page' => $aPage, 'order' => 'create_time asc'));
        } else {
            $first = D('Group/GroupType')->where(array('id' => $aTypeId, 'status' => 1))->page($aPage, 10)->order('create_time desc')->find();
            if ($first['pid'] == 0) {
                $second = D('Group/GroupType')->getList(array('field' => 'id', 'where' => array('status' => 1,'pid' => $first['id']),'page'=>$aPage,'order'=>'create_time desc'));
                $ids = array();
                foreach ($second as &$s) {
                    $ids = array_merge($ids, array_column($second, 'id'));
                }
                $map = array_merge($ids, array($first['id']));
                $map['type_id'] = array('in', $map);
                $map['status']=1;
                $Groups = D('Group/Group')->getList(array('field' => 'id', 'where' => $map, 'page' => $aPage, 'order' => 'create_time asc'));

            } else {
                $Groups = D('Group/Group')->getList(array('field' => 'id', 'where' => array('type_id' => $aTypeId, 'status' => 1), 'page' => $aPage, 'order' => 'create_time asc'));
            }
        }

        foreach ($Groups as &$c) {
            $c = $GroupModel->getGroup($c);
        }
        unset($c);

        if (!$Groups) {
            $this->apiError('寺院返回失败！');
        } else {
            $this->apiSuccess('返回成功', $Groups);
        }

    }

    //返回寺院详情
    public function getGroupDetail()
    {

        $group_id = I_POST('id', 'intval');
        $Group = D('Api/Group')->getGroup($group_id);
        if ($Group) {
            $this->apiSuccess('返回成功', $Group);
        } else {
            $this->apiError('该寺院下无置顶帖子');
        }
    }

//返回置顶帖子信息
    public function getTopPost()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $group_id = I('id', 'intval');
        $Group = D('Api/Group')->getGroup($group_id);
        if (!$Group) {
            $this->apiError('该寺院不存在');
        }

        $TopPost = D('Group/GroupPost')->getList(array('field' => 'id', 'where' => array('is_top' => 1, 'status' => 1, 'group_id' => $group_id), 'page' => $aPage, 'order' => 'create_time asc'));
        foreach ($TopPost as &$p) {
            $TopPost = D('Api/Group')->getPost($p);
        }
        unset($p);
        if ($TopPost) {
            $this->apiSuccess('返回成功', $TopPost);
        } else {
            $this->apiError('该寺院下无置顶帖子');
        }
    }

//返回寺院成员信息
    public function getGroupMember()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aId = I('id','intval');
        $Group = D('Group/Group')->where(array('id' => $aId, 'status' => 1))->find();
        if (!$Group) {
            $this->apiError('没有此寺院');
        }
        $GroupMenmber = D('Group/GroupMember')->where(array('group_id' => $aId))->page($aPage, 10)->order('create_time asc')->select();
        $GroupCreator = D('Group/Group')->where(array('id' => $aId))->field('uid')->find();
        foreach ($GroupMenmber as &$user) {
            $user['user'] = D('Api/User')->getUserReduceInfo($user['uid']);
            $user['create_time'] = friendlyDate($user['create_time']);
            $user['update_time'] = friendlyDate($user['update_time']);
            $user['last_view'] = friendlyDate($user['last_view']);
            if (in_array($user['uid'], $GroupCreator)) {
                $user['isCreator'] = '1';
            } else {
                $user['isCreator'] = '0';
            }
        }
        unset($user);
        if ($GroupMenmber) {
            $this->apiSuccess('返回成功', $GroupMenmber);
        } else {
            $this->apiError('该寺院暂无人加入！');
        }

    }

    //返回我的寺院信息
    public function getWeGroupAll()
    {
        $mid = $this->requireIsLogin();
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $member = D('GroupMember')->where(array('uid' => $mid, 'status' => 1))->field('group_id')->select();
        $group_ids = getSubByKey($member, 'group_id');
        $myAttend = D('Group/Group')->getList(array('field' => 'id', 'where' => array('id' => array('in', $group_ids), 'status' => 1), 'page' => $aPage, 'order' => 'uid = ' . $mid . ' desc'));
        $GroupModel = D('Api/group');
        foreach ($myAttend as &$g) {
            $g = $GroupModel->getGroup($g);
        }
        unset($g);
        $this->apiSuccess('返回成功', $myAttend);
    }

    //返回寺院下的帖子信息
    public function getPostAll()
    {
        $aPage = I_POST('page', 'intval');
        if (empty($aPage)) {
            $aPage = 1;
        }
        $aGroupId = I_POST('group_id', 'intval');
        $aCateId = I_POST('cate_id', 'intval');
        if ($aGroupId) {
            if (empty($aCateId)) {
                $Posts = D('Group/GroupPost')->getList(array('field' => 'id', 'where' => array('status' => 1, 'group_id' => $aGroupId), 'page' => $aPage, 'order' => 'create_time desc'));
            } else {
                $Posts = D('Group/GroupPost')->getList(array('field' => 'id', 'where' => array('cate_id' => $aCateId, 'status' => 1, 'group_id' => $aGroupId), 'page' => $aPage, 'order' => 'create_time desc'));
            }
        } else {
            if (empty($aCateId)) {
                $Posts = D('Group/GroupPost')->getList(array('field' => 'id', 'where' => array('status' => 1), 'page' => $aPage, 'order' => 'create_time desc'));
            } else {
                $Posts = D('Group/GroupPost')->getList(array('field' => 'id', 'where' => array('cate_id' => $aCateId, 'status' => 1), 'page' => $aPage, 'order' => 'create_time desc'));
            }
        }

        $GroupModel = D('Api/group');
        foreach ($Posts as &$p) {
            $p = $GroupModel->getPost($p);
            unset($p['content']);
        }
        unset($p);
        if (!$Posts) {
            $this->apiError('帖子数据返回失败');
        } else {
            $this->apiSuccess('返回成功', $Posts);
        }

    }

    //获取帖子信息
    public function postDetail()
    {
        $aPostId = I_POST('id', 'intval');
        $post = D('Api/group')->getPost($aPostId);
        if (!$post) {
            $this->apiError('帖子数据返回失败');
        } else {
            $aPage = I_POST('page', 'intval');
            $aCount = 10;
            $aId = I_POST('post_id', 0, 'intval');
            $map['status'] = 1;
            $aId && $map['post_id'] = $aId;
            $replyList = D('Group/GroupPostReply')->where($map)->page($aPage, $aCount)->select();
            $uid = D('Group/GroupPost')->where(array('id' => $aId))->field('uid')->select();
            $uid = array_column($uid, 'uid');
            
            $arr = array();
            
            foreach ($replyList as &$v) {
                preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $v['content'], $arr); //匹配所有的图片
                $v['imgList'] = $arr[1];
                $v['create_time'] = friendlyDate($v['create_time']);
                $v['update_time'] = friendlyDate($v['update_time']);
                $v['user'] = D('Api/User')->getUserSimpleInfo($v['uid']);
                $v['toReplyList'] = D('Group/GroupLzlReply')->where(array('to_f_reply_id'=>$v['id'],'starus'=>1))->limit(3)->select();
                foreach ($v['toReplyList']  as &$c) {
                    $c['create_time'] = friendlyDate($c['create_time']);
                    $c['user'] = D('Api/User')->getUserSimpleInfo($c['uid']);
                    if (in_array($c['uid'], $uid)) {
                        $c['is_landlord'] = '1';
                    } else {
                        $c['is_landlord'] = '0';
                    }
                }
                unset($c);
                if (in_array($v['uid'], $uid)) {
                    $v['is_landlord'] = '1';
                } else {
                    $v['is_landlord'] = '0';
                }
                $v['lzl_reply_count'] = D('group/groupLzlReply')->where(array('to_f_reply_id' => $v['id']))->count();
            }
            unset($v);
            $data['post']=$post;
            $data['replylist']=$replyList;
            $this->apiSuccess('返回成功', $data);
            //$this->apiSuccess('返回成功', $post);
        }

    }

    //创建与编辑寺院
    public function addGroup()
    {
        $mid = $this->requireIsLogin();
        if (!$mid) {
            $this->apiError('请登陆后再操作寺院。');
        }
        //基本信息
        $aTitle = I_POST('title', 'op_t');
        $aDetail = I_POST('detail', 'op_h');
        $aTypeId = I_POST('type_id', 'intval');
        $aBackground = I_POST('background', 'intval');
        $aType = I_POST('type', 'intval');
        $aLogo = I_POST('logo', 'intval');
        $aId = I('get.id', '', 'intval');
        $aMemberAlias = I_POST('member_alias', '成员', 'text');

        if (trim(op_t($aTitle)) == '') {
            $this->apiError('请输入标题。');
        }
        if (utf8_strlen($aTitle) > 20) {
            $this->error('寺院名称最多20个字');
        }
        if ($aTypeId == 0) {
            $this->apiError('请选择分类。');
        }
        if (trim(op_h($aDetail)) == '') {
            $this->apiError('请填写寺院介绍。');
        }
        $data = D('Group/Group')->create();
        $data['detail'] = $aDetail;
        $data['title'] = $aTitle;
        $data['logo'] = $aLogo;
        $data['background'] = $aBackground;
        $data['type'] = $aType;
        $data['type_id'] = $aTypeId;
        $data['create_time'] = time();
        $data['uid'] = is_login();
        $data['member_alias'] = $aMemberAlias;
        $isEdit = $aId ? true : false;
        if ($isEdit) {
            $this->requireIsLogin();
            $this->requireGroupExists($aId);

            $this->checkActionLimit('edit_group', 'Group', $aId, is_login(), true);

            $this->ApiCheckAuth('Group/Index/editGroup', get_group_admin($aId), '您无编辑寺院权限');
        } else {
            $this->checkActionLimit('add_group', 'Group', 0, is_login(), true);
            $this->ApiCheckAuth('Group/Index/addGroup', -1, '您无添加寺院权限');
        }
        $need_verify = modC('GROUP_NEED_VERIFY', 0, 'GROUP');
        $model = D('Group/Group');
        if ($isEdit) {
            $data['status'] = $need_verify ? 0 : 1;
            $result = $model->save($data);
            $group_id = $aId;
        } else {
            $data['status'] = $need_verify ? 0 : 1;
            $result = D('Group/Group')->add($data);

            if (!$result) {
                $this->apiError('创建寺院失败：' . $model->getError());
            }
            $group_id = $result;
            //向GroupMember表添加创建者成员
            D('GroupMember')->add(array('uid' => is_login(), 'group_id' => $group_id, 'status' => 1, 'position' => 3));
        }
        if ($need_verify) {
            $message = '创建成功，请耐心等候管理员审核。';
            // 发送消息
            D('Common/Message')->sendMessage(1, get_nickname($mid) . "创建了寺院【{$aTitle}】，快去审核吧。", '寺院创建审核', 'admin/group/unverify', array(), $mid);

            $this->apiSuccess($message, U('group/index/index'));
        }
        // 发送微博
        if (D('Module')->checkInstalled('Weibo')) {
            $postUrl = "http://$_SERVER[HTTP_HOST]" . U('Group/Index/group', array('id' => $group_id));
            if ($isEdit && check_is_in_config('edit_group', modC('GROUP_SEND_WEIBO', 'add_group,edit_group', 'GROUP'))) {
                D('Weibo/Weibo')->addWeibo(is_login(), "我修改了寺院【" . $aTitle . "】：" . $postUrl);
            }
            if (!$isEdit && check_is_in_config('add_group', modC('GROUP_SEND_WEIBO', 'add_group,edit_group', 'GROUP'))) {
                D('Weibo/Weibo')->addWeibo(is_login(), "我创建了一个新的寺院【" . $aTitle . "】：" . $postUrl);
            }

        }

        //显示成功消息
        $message = $isEdit ? '编辑成功。' : '发表成功。';
        $GroupModel = D('Api/group');
        $res = $GroupModel->getGroup($group_id);
        $this->apiSuccess($message, $res);

    }

    //发布或编辑帖子
    public function sendPost()
    {
        $mid = $this->requireIsLogin();
        $aGroupId = I_POST('group_id', 0, 'intval');
        $aPostId = I('get.id', 0, 'intval');
        $aTitle = I_POST('title', 'op_t');
        $aContent = I_POST('content', 'op_h');
        $aCategory = I_POST('cate_id', 'intval');
        $attach_id = I_POST('attach_id', 'op_t');
        $attach_ids = explode(',', $attach_id);
        foreach ($attach_ids as $k => $v) {
            $aContent .= "<p><img src='" . get_cover($v, 'path') . "'/></p>";
        }
        unset($v);

        $aContent = str_replace("\\", '', $aContent);
        $check = D('Group/GroupMember')->where(array('group_id' => $aGroupId, 'uid' => $mid))->find();

        if ($check['status'] != 1) {

            $this->apiError('您无编辑帖子权限');
        }

        //判断是不是编辑模式
        $isEdit = $aPostId ? true : false;
        //如果是编辑模式，确认当前用户能编辑帖子
        $this->requireIsLogin();
        $this->requireGroupExists($aGroupId);

        if ($isEdit) {
            $this->requirePostExists($aPostId);
            $this->checkActionLimit('edit_group_post', 'GroupPost', $aPostId, $mid, true);
            $this->ApiCheckAuth('Group/Index/edit', get_post_admin($aPostId), '您无编辑帖子权限');
        } else {
            $this->checkActionLimit('add_group_post', 'GroupPost', 0, $mid, true);
            $this->ApiCheckAuth('Group/Index/addPost', -1, '您无添加帖子权限');
        }

        if (empty($aGroupId)) {
            $this->apiError('请选择帖子所在的寺院');
        }
        if (empty($aTitle)) {
            $this->apiError('请填写帖子标题');
        }
        if (empty($aContent)) {
            $this->apiError('请填写帖子内容');
        }
        $model = D('Group/GroupPost');
        $cover = get_pic($aContent);
        $cover = $cover == null ? '' : $cover;
        $len = modC('SUMMARY_LENGTH', 50);
        if ($isEdit) {
            $data = array('id' => $aPostId, 'title' => $aTitle, 'summary' => mb_substr(text($aContent), 0, $len, 'utf-8'), 'cover' => $cover, 'status' => '1', 'update_time' => time(), 'content' => $aContent, 'parse' => 0, 'group_id' => $aGroupId, 'cate_id' => $aCategory);
            $result = $model->save($data);
            //添加到最新动态
            $dynamic['group_id'] = $aGroupId;
            $dynamic['uid'] = $mid;
            $dynamic['type'] = 'update_post';
            $dynamic['row_id'] = $aPostId;
            D('GroupDynamic')->add($dynamic);
            if (!$result) {
                $this->apiError('编辑失败：' . $model->getError());
            }
        } else {
            $data = array('uid' => $mid, 'title' => $aTitle, 'summary' => mb_substr(text($aContent), 0, $len, 'utf-8'), 'cover' => $cover, 'status' => '1', 'create_time' => time(), 'update_time' => time(), 'content' => $aContent, 'parse' => 0, 'group_id' => $aGroupId, 'cate_id' => $aCategory);
            $result = $model->add($data);
            if (!$result) {
                $this->apiError('发表失败。');
            }
            $aPostId = $result;
            //添加到最新动态
            $dynamic['group_id'] = $aGroupId;
            $dynamic['group_id'] = $aGroupId;
            $dynamic['uid'] = $mid;
            $dynamic['type'] = 'post';
            $dynamic['row_id'] = $aPostId;
            D('Group/GroupDynamic')->add($dynamic);
            //增加活跃度
            D('Group/Group')->where(array('id' => $aGroupId))->setInc('activity');
            D('Group/Group')->where(array('id' => $aGroupId))->setInc('post_count');
            D('Group/GroupMember')->where(array('group_id' => $aGroupId, 'uid' => $mid))->setInc('activity');
        }


        //显示成功消息
        $message = $isEdit ? '编辑成功。' : '发表成功。' . cookie('score_tip');
        //返回成功消息
        //实现发布帖子发布图片微博(公共内容)
        $post = D('Api/group')->getPost($aPostId);
        $group = D('group/group')->where(array('id' => $post ['group_id']))->find();
        $this->sendWeibo($aPostId, $isEdit, $group);
        $this->apiSuccess($message, $post);

    }

    //解散寺院
    public function endGroup()
    {
        $mid = $this->requireIsLogin();
        $aGroupId = I_POST('id', 'intval');
        $Group = D('Group/Group')->where(array('status' => 1, 'id' => $aGroupId))->find();
        if (!$Group) {
            $this->apiError('寺院不存在！');
        }
        if ($Group['uid'] == $mid || is_administrator($mid)) {
            $res = D('Group/Group')->where(array('status' => 1, 'id' => $aGroupId))->setField('status', -1);
            if ($res) {
                $this->apisuccess('解散成功！');
            } else {
                $this->apiError('解散操作失败！');
            }
        } else {
            $this->apiError('非寺院发起者操作！');
        }

    }

    //得到帖子的点赞回复数
    public function getPostPRM()
    {
        $aPostId = I_POST('id', 'intval');
        $Posts = D('Group/GroupPost')->where(array('status' => 1, 'id' => $aPostId))->find();
        $Posts['supportCount'] = D('support')->where(array('appname' => 'Group', 'row' => $aPostId, 'table' => 'post'))->count();
        $Post['supportCount'] = $Posts['supportCount'];
        if (empty($Posts['reply_count'])) {
            $Post['reply_count'] = '0';
        } else {
            $Post['reply_count'] = $Posts['reply_count'];
        }
        $this->apiSuccess('返回成功', $Post);
    }

    //公告信息
    public function getNotice()
    {
        $aGroupId = I_POST('group_id', 'intval');
        $Notice = D('Group/GroupNotice')->where($aGroupId)->find();
        $Notice['create_time'] = friendlyDate($Notice['create_time']);
        $this->apiSuccess('返回成功', $Notice);
    }

    //加入寺院
    public function joinGroup()
    {
        $mid = $this->requireIsLogin();
        $aGroupId = I_POST('group_id', 'intval');
        //查询权限
        $group = D('Group/Group')->where(array('id' => $aGroupId, 'status' => 1))->find();
        if (!$group) {
            $this->apiError('该寺院不存在');
        }
        //判断是否已经加入
        $is_join = D('Group/GroupMember')->where(array('group_id' => $aGroupId, 'uid' => $mid, 'status' => 1))->find();
        if ($is_join) {
            $this->apiError('已经加入了该寺院');
        }
        // 已经加入但还未审核
        if (D('Group/GroupMember')->where(array('uid' => $mid, 'group_id' => $aGroupId, 'status' => 0))->select()) {
            $this->apiError('请耐心等待管理员审核');
        }

        // 获取寺院的类型 0为公共的 1为私有的

        $group = D('Group/Group')->where(array('id' => $aGroupId, 'status' => 1))->find();
        $type = $group['type'];
        //要存入数据库的数据
        $data['group_id'] = $aGroupId;
        $data['uid'] = $mid;
        $data['create_time'] = time();

        if ($type == 1) {
            // 寺院为私有的。
            $data['status'] = 0;
            $res = D('Group/GroupMember')->add($data);
            $group = D('Group/Group')->where(array('status' => 1, 'id' => $aGroupId))->find();
            // 发送消息
            D('Message')->sendMessage($group['uid'], get_nickname($mid) . "请求加入寺院【{$group['title']}】", '加入寺院审核', U('group/Manage/member', array('group_id' => $aGroupId, 'status' => 0)), $mid);
//            $list['title']='寺院';
//            $list['content']= get_nickname($mid) . "请求加入寺院【{$group['title']}】";
//            $list['message']='加入寺院审核';
//            $list['group_id']=$aGroupId;
//            $list['message_type']='group';
//            $arr=array($group['uid']);
//            $list['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$list);
            $this->clearcache($aGroupId);
            if ($res) {
                $this->apiSuccess('加入成功，等待寺院管理员审核！');
            } else {
                $this->apiError('加入失败');
            }
        } else {
            // 寺院为公共的
            $data['status'] = 1;
            $data['update_time'] = $data['create_time'];
            $res = D('Group/GroupMember')->add($data);
            //添加到最新动态
            $dynamic['group_id'] = $aGroupId;
            $dynamic['uid'] = $mid;
            $dynamic['type'] = 'attend';
            $dynamic['create_time'] = $data['create_time'];
            D('Group/GroupDynamic')->add($dynamic);
            if ($res) {
                D('Group/Group')->where(array('id' => $aGroupId))->setInc('member_count');
                $this->apiSuccess('加入成功');
            } else {
                $this->apiError('加入失败');
            }
        }


    }

    //退出寺院
    public function quitGroup()
    {
        $mid = $this->requireIsLogin();
        $aGroupId = I_POST('group_id', 'intval');
        $Reg = D('Group/Group')->where(array('status' => 1, 'id' => $aGroupId))->find();

        if (!$Reg) {
            $this->apiError('寺院不存在！');
        }
        $res = D('Group/GroupMember')->where(array('status' => 1, 'group_id' => $aGroupId, 'uid' => $mid))->delete();
        //添加到最新动态
        $dynamic['group_id'] = $aGroupId;
        $dynamic['uid'] = $mid;
        $dynamic['type'] = 'quit';
        $dynamic['create_time'] = time();
        D('Group/GroupDynamic')->add($dynamic);
        if ($res) {
            D('Group/Group')->where(array('id' => $aGroupId))->setDec('member_count');
            $this->apiSuccess('退出成功！');
        } else {
            $this->apiError('你还未加入此寺院，无法退出！');
        }

    }

    //邀请好友加入
    public function GroupInvite()
    {
        $mid = $this->requireIsLogin();
        $aId = I_POST('id');
        $toUid = I_POST('uid');
        $group = D('Group/Group')->find($aId);
        $friend = D('Follow')->where(array('who_follow' => $mid, 'follow_who' => $toUid))->find();
        if ($friend['follow_who']) {
            D('Common/Message')->sendMessage($toUid, get_nickname($mid) . "邀请您加入寺院【{$group['title']}】  <a class='ajax-post' href='" . U('group/index/attend', array('group_id' => $aId)) . "'>接受邀请</a>", '邀请加入寺院', U('group/index/group', array('id' => $aId)), $mid);
//            $list['title']='寺院';
//            $list['content']= get_nickname($mid) . "邀请您加入寺院【{$group['title']}】";
//            $list['message']='邀请加入寺院';
//            $list['group_id']=$aId;
//            $list['message_type']='group';
//            $arr=array($toUid);
//            $list['cids']=D('Api/User')->getUserCID($arr);
//            D('Api/Igt')->pushMessageToSingle(4,$list);
            //添加到最新动态
            $dynamic['group_id'] = $aId;
            $dynamic['uid'] = $toUid;
            $dynamic['type'] = 'invite';
            $dynamic['create_time'] = time();
            D('Group/GroupDynamic')->add($dynamic);
            $this->apisuccess('邀请成功！');
        } else {
            $this->apisuccess('邀请失败！');
        }
    }

    //剔除组员
    public function rejectGroupPeople()
    {
        $mid = $this->requireIsLogin();
        $aGroupId = I('get.id', '', 'intval');
        $aUid = I_POST('uid', 'intval');
        $map['status'] = 1;
        $aGroupId && $map['group_id'] = $aGroupId;

        $Group = D('Group/Group')->where(array('id' => $aGroupId))->find();
        if (!is_administrator($mid)) {
            //不是管理员则进行检测
            if ($Group['uid'] != $mid) {
                $this->apiError('无权管理成员');
            }
        }
        //剔除组员
        $rejectGroupPeople = D('Group/GroupMember')->where(array('group_id' => $aGroupId, 'status' => 1, 'uid' => $aUid))->delete();
        $dynamic['group_id'] = $aGroupId;
        $dynamic['uid'] = $mid;
        $dynamic['type'] = 'remove';
        $dynamic['create_time'] = time();
        D('Group/GroupDynamic')->add($dynamic);
        if ($rejectGroupPeople) {
            D('Group/Group')->where(array('id' => $aGroupId))->setDec('member_count');
            $this->apiSuccess('移出成功！');
        } else {
            $this->apiError('移出操作失败！');
        }
    }

    //添加组员（审核组员）接口
    public function addGroupPeople()
    {
        $mid = $this->requireIsLogin();
        $aGroupId = I('get.id', '', 'intval');
        $aUid = I_POST('uid', 'intval');
        $map['status'] = 1;
        $aGroupId && $map['group_id'] = $aGroupId;

        $Group = D('Group/Group')->where(array('id' => $aGroupId))->find();
        if (!is_administrator($mid)) {
            //不是管理员则进行检测
            if ($Group['uid'] != $mid) {
                $this->apiError('无权管理成员');
            }
        }
        //审核
        $addGroupPeople = D('Group/GroupMember')->where(array('group_id' => $aGroupId, 'status' => 0, 'uid' => $aUid))->setField('status', 1);
        if ($addGroupPeople) {
            $this->apiSuccess('审核成功！');
        } else {
            $this->apiError('审核操作失败！');
        }
    }

//新建帖子分类操作
    public function addPostCategory()
    {
        $mid = $this->requireIsLogin();
        $aGroupId = I('group_id', 0, 'intval');
        $aTitle = I('title', '', 'op_h');
        $aId = I('id', 0, 'intval');

        //数据配置
        $data = D('Group/GroupPostCategory')->create();
        $data['title'] = $aTitle;
        $data['create_time'] = time();
        $Group = D('Group/Group')->where(array('id' => $aGroupId))->find();
        if (!$Group) {
            $this->apiError('帖子不存在。');
        }
        if (!$aTitle) {
            $this->apiError('请填写分类标题。');
        }
        if ($aId) {
            if (!is_administrator($mid)) {
                //不是管理员则进行检测
                if ($Group['uid'] != $mid) {
                    $this->apiError('无权编辑');
                }
            }
            //编辑基本信息
            $Cate = D('Group/GroupPostCategory')->where(array('id' => $aId))->save($data);
            if ($Cate) {
                $this->apiSuccess('编辑分类成功');
            } else {
                $this->apiError('编辑分类成功');
            }
        } else {
            $data['status'] = 1;
            $data['group_id'] = $aGroupId;
            $Cate = D('Group/GroupPostCategory')->add($data);
            if ($Cate) {
                $this->apiSuccess('增加分类成功');
            } else {
                $this->apiError('增加分类失败');
            }

        }
    }

//删除帖子分类
    public function delPostCategory()
    {
        $mid = $this->requireIsLogin();


        $aId = I_POST('id', 'intval');
        if (!$aId) {
            $this->apiError('请选择要删除的帖子分类');
        }
        $Cate = D('Group/GroupPostCategory')->where(array('id' => $aId, 'status' => 1))->find();
        if (!$Cate) {
            $this->apiError('该帖子分类不存在');
        }
        $Group = D('Group/Group')->where(array('id' => $Cate['group_id']))->find();


        if ($aId) {

            if (!is_administrator($mid)) {
                //不是管理员则进行检测

                if ($Group['uid'] != $mid) {
                    $this->apiError('无权编辑');
                }

            }
            $Cate = D('Group/GroupPostCategory')->where(array('id' => $aId))->setField('status', 0);

            if ($Cate['status'] == 0) {
                $this->apiSuccess('帖子分类删除成功！');
            }
        }


    }

//展示帖子分类
    public function PostCategory()
    {
        $aGroupId = I_POST('group_id', 0, 'intval');
        $map['status'] = 1;
        $aGroupId && $map['group_id'] = $aGroupId;
        /*$aContent= I('content','', 'op_t');*/
        $PostCategory = D('Group/GroupPostCategory')->where($map)->order('sort asc')->select();
        if (!$PostCategory) {
            $this->apiError('该寺院下没有帖子分类');
        }
        $this->apiSuccess('返回成功', $PostCategory);
    }

//展示帖子回复信息
    public function getPostReply()
    {
        $aPage = I_POST('page', 'intval');
        $aCount = 10;
        $aId = I_POST('post_id', 0, 'intval');
        $map['status'] = 1;
        $aId && $map['post_id'] = $aId;
        $replyList = D('Group/GroupPostReply')->where($map)->page($aPage, $aCount)->select();
        $uid = D('Group/GroupPost')->where(array('id' => $aId))->field('uid')->select();
        $uid = array_column($uid, 'uid');

        $arr = array();

        foreach ($replyList as &$v) {
            preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $v['content'], $arr); //匹配所有的图片
            $v['imgList'] = $arr[1];
            $v['create_time'] = friendlyDate($v['create_time']);
            $v['update_time'] = friendlyDate($v['update_time']);
            $v['user'] = D('Api/User')->getUserSimpleInfo($v['uid']);
            $v['toReplyList'] = D('Group/GroupLzlReply')->where(array('to_f_reply_id'=>$v['id'],'starus'=>1))->limit(3)->select();
            foreach ($v['toReplyList']  as &$c) {
                $c['create_time'] = friendlyDate($c['create_time']);
                $c['user'] = D('Api/User')->getUserSimpleInfo($c['uid']);
                if (in_array($c['uid'], $uid)) {
                    $c['is_landlord'] = '1';
                } else {
                    $c['is_landlord'] = '0';
                }
            }
            unset($c);
            if (in_array($v['uid'], $uid)) {
                $v['is_landlord'] = '1';
            } else {
                $v['is_landlord'] = '0';
            }
            $v['lzl_reply_count'] = D('group/groupLzlReply')->where(array('to_f_reply_id' => $v['id']))->count();
        }
        unset($v);

        $this->apiSuccess('返回成功', $replyList);
    }

//回复帖子
    public function doReplyPost()
    {
        $mid = $this->requireIsLogin();

        $aPostId = I_POST('post_id', 0, 'intval');
        $map['status'] = 1;
        $aPostId && $map['post_id'] = $aPostId;
        if (!$aPostId) {
            $this->apiError('帖子不存在');
        }
        $aContent = I_POST('content', 'op_t');
        $uid = D('Group/GroupPost')->where(array('id' => $aPostId))->field('uid')->select();
        $uid = array_column($uid, 'uid');
        $data = array('post_id' => $aPostId, 'content' => text($aContent), 'status' => '1', 'update_time' => time(), 'create_time' => time(), 'uid' => $mid);
        $result = D('Group/GroupPostReply')->add($data);

        $reply = D('Group/GroupPostReply')->where(array('id' => $result))->find();
        preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/", $reply['content'], $arr); //匹配所有的图片
        $reply['imgList'] = $arr[1];
        $reply ['user'] = D('Api/User')->getUserSimpleInfo($mid);

        $reply['toReplyList'] = array();

        if (in_array($reply['uid'], $uid)) {
            $val['is_landlord'] = '1';
        } else {
            $val['is_landlord'] = '0';
        }

        //增加活跃度
        $group = M('GroupPost')->where(array('id'=>$reply['post_id']))->find();
        M('Group')->where(array('id' => $group['group_id']))->setInc('activity');
        M('GroupMember')->where(array('group_id' =>  $group['group_id'], 'uid' => is_login()))->setInc('activity');
        $groupPostModel =  M('GroupPost');
        //增加帖子的回复数
        $groupPostModel->where(array('id' => $aPostId))->setInc('reply_count');
        //更新最后回复时间
        $groupPostModel->where(array('id' => $aPostId))->setField('last_reply_time', time());
        $this->apiSuccess('返回成功', $reply);
    }

//展示楼中楼的回复
    public function PostLzl()
    {
        $aPage = I_POST('page', 'intval');
        $aCount = 10;

        $aPostId = I_POST('post_id', 'intval');

        $aId = I_POST('to_f_reply_id', 'intval');
        $map['status'] = 1;
        $aId && $map['to_f_reply_id'] = $aId;

        $uid = D('Group/GroupPost')->where(array('id' => $aPostId))->field('uid')->select();
        $uid = array_column($uid, 'uid');

        $LzlPost = D('Group/GroupLzlReply')->where($map)->page($aPage, $aCount)->select();

        foreach ($LzlPost as &$v) {
            $v['create_time'] = friendlyDate($v['create_time']);
            $v['user'] =  D('Api/User')->getUserSimpleInfo($v['uid']);
            if (in_array($v['uid'], $uid)) {
                $v['is_landlord'] = '1';
            } else {
                $v['is_landlord'] = '0';
            }
        }
        unset($v);

        $this->apiSuccess('返回成功', $LzlPost);
    }

//回复帖子的回复
    public function doPostLzl()
    {
        $mid = $this->requireIsLogin();

        $aToReplyId = I_POST('to_reply_id', 'intval');
        $aContent = I_POST('content', 'op_t');

        if ($aToReplyId) {

            $reply = M('GroupLzlReply')->where(array('id' => $aToReplyId))->find();

            $data['post_id'] = $reply['post_id'];
            $data['to_f_reply_id'] = $reply['to_f_reply_id'];
            $data['to_uid'] = $reply['uid'];
            $data['uid'] = $mid;
            $data['create_time'] = time();
            $data['content'] = $aContent;
            $data['to_reply_id'] = $aToReplyId;
            $data['status'] = 1;
        } else {
            $aFToReplyId = I_POST('to_f_reply_id','intval');

            $reply =D('GroupPostReply')->where(array('id' => $aFToReplyId, 'status' => 1))->find();

            $data['post_id'] = $reply['post_id'];
            $data['to_f_reply_id'] = $aFToReplyId;
            $data['to_uid'] = $reply['uid'];
            $data['uid'] = $mid;
            $data['create_time'] = time();
            $data['content'] = $aContent;
            $data['status'] = 1;
        }

        $post_id = $data['post_id'];

        $data = M('GroupLzlReply')->create($data);
        if (!$data) return false;
        $result = M('GroupLzlReply')->add($data);


        //增加活跃度
        $group_id = $this->getGroupIdByPost($reply['post_id']);
        M('Group')->where(array('id' => $group_id))->setInc('activity');
        M('GroupMember')->where(array('group_id' => $group_id, 'uid' => is_login()))->setInc('activity');
        $groupPostModel =  M('GroupPost');
        //增加帖子的回复数
        $groupPostModel->where(array('id' => $post_id))->setInc('reply_count');
        //更新最后回复时间
        $groupPostModel->where(array('id' => $post_id))->setField('last_reply_time', time());
        $res = M('GroupLzlReply')->where(array('id' => $result))->find();
        $res['user']=D('Api/User')->getUserSimpleInfo($res['uid']);
        $this->apiSuccess('返回成功', $res);
    }

//返回热门帖子
    public function getHotPost()
    {
        $aPage = I_POST('page', 1, 'intval');
        $aCount = 10;
        $group_id = I_POST('group_id', 0, 'intval');
        $group = D('Group/Group')->where(array('status' => 1, 'id' => $group_id))->find();
        if (!$group) {
            $this->apiError('该寺院不存在');
        }
        $HotPost = D('Group/GroupPost')->where(array('status' => 1, 'group_id' => $group_id))->page($aPage, $aCount)->order('reply_count desc')->limit(10)->select();
        foreach ($HotPost as &$p) {
            $p['create_time'] = friendlyDate($p['create_time']);
            $p['title'] = op_t($p['title']);
            $p['last_reply_time'] = friendlyDate($p['last_reply_time']);
            $p['update_time'] = friendlyDate($p['update_time']);
            $p['user'] = query_user(array('uid', 'username', 'nickname', 'avatar128'), $p['uid']);
            $p['supportCount'] = D('support')->where(array('appname' => 'Group', 'row' => $p['id'], 'table' => 'post'))->count();
            if (D('support')->where(array('appname' => 'Group', 'row' => $p['id'], 'uid' => is_login(), 'table' => 'post'))->find()) {
                $p['is_support'] = '1';
            } else {
                $p['is_support'] = '0';
            }
        }
        unset($p);

        $this->apiSuccess('返回成功', $HotPost);
    }

//帖子收藏
    public function postBookmark()
    {
        $mid = $this->requireIsLogin();
        $aPostId = I_POST('post_id','intval');
        $Post = D('Group/GroupPost')->where(array('id' => $aPostId, 'status' => 1))->find();
        if (!$Post) {
            $this->apiError('收藏失败，帖子不存在');
        }
        $collection = D('Group/GroupBookmark')->where(array('post_id' => $aPostId, 'uid' => $mid))->find();
        if (!$collection) {
            $data['uid'] = $mid;
            $data['post_id'] = $aPostId;
            $data['create_time'] = time();
            //写入数据库
            D('Group/GroupBookmark')->add($data);
            $this->apiSuccess('收藏成功');
        } else {
            $this->apiError('已收藏，请勿重复收藏');
        }
        $this->apiSuccess('返回成功');
    }

//取消收藏
    public function RejectBookmark()
    {
        $mid = $this->requireIsLogin();
        $aPostId = I_POST('post_id', 'intval');
        $collection = D('Group/GroupBookmark')->where(array('post_id' => $aPostId, 'uid' => $mid))->select();
        if (!$collection) {
            $this->apiError('取消失败,无收藏记录');
        } else {
            D('Group/GroupBookmark')->where(array('post_id' => $aPostId, 'uid' => $mid))->delete();
            $this->apiSuccess('取消收藏成功');
        }
    }

    //收藏
    public function getBookmark()
    {
        $mid = $this->requireIsLogin();
        $aPage = I_POST('page','intval');
        $collection = D('Group/GroupBookmark')->where(array('uid' => $mid))->page($aPage,10)->select();
        $GroupModel=D('Api/Group');

        foreach ($collection as &$p) {
            $p = $GroupModel->getPost($p['post_id']);
            unset($p['content']);
        }
        unset($p);

        if (!$collection) {

            $this->apiError('暂无收藏记录');
        } else {
            $this->apiSuccess('收藏列表成功',$collection);
        }
    }

    /*——————————————————————私有函数————————————————————————————*/
//验证是否允许登陆 板块拥有权限 用户组是否拥有权限
    private
    function requireGroupAllowPublish($aGroupId)
    {

        $this->requireGroupExists($aGroupId);
        $this->requireIsLogin();
        $this->requireGroupAllowCurrentUserGroup($aGroupId);
    }


//确认寺院是否存在
    private
    function requireGroupExists($aId)
    {
        if (!$this->isGroupExists($aId)) {
            $this->apiError('寺院不存在');
        }
    }

    private
    function isGroupExists($aId)
    {
        $aId = intval($aId);
        $group = D('Group/Group')->where(array('id' => $aId, 'status' => 1));
        return $group ? true : false;
    }

    private
    function requireGroupAllowCurrentUserGroup($aGroupId)
    {
        $aGroupId = intval($aGroupId);
        if (!$this->isgroupAllowCurrentUserGroup($aGroupId)) {
            $this->apiError('该板块不允许发帖');
        }
    }

    protected function requirePostExists($post_id)
    {
        if (!post_is_exist($post_id)) {
            $this->error('帖子不存在');
        }
    }


    private
    function isGroupAllowCurrentUserGroup($aId)
    {
        $aId = intval($aId);
        //如果是超级管理员，直接允许
        if (is_login() == 1) {
            return true;
        }

        //如果帖子不属于任何板块，则允许发帖
        if (intval($aId) == 0) {
            return true;
        }

        //读取寺院的基本信息
        $group = D('Group/Group')->where(array('id' => $aId))->find();
        $userGroups = explode(',', $group['allow_user_group']);

        //读取用户所在的用户组
        $list = M('AuthGroupAccess')->where(array('uid' => is_login()))->select();
        foreach ($list as &$e) {
            $e = $e['group_id'];
        }

        //每个用户都有一个默认用户组
        $list[] = '1';

        //判断用户组是否有权限
        $list = array_intersect($list, $userGroups);
        return $list ? true : false;
    }


}