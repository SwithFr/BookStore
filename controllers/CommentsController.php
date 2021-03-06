<?php


namespace Controllers;


use Components\Request;
use Components\Session;
use Components\Validator;
use Models\Interfaces\CommentsRepositoryInterface;

class CommentsController extends AppController
{
    function __construct(Request $request, CommentsRepositoryInterface $comment)
    {
        parent::__construct($request);
        $this->Comment = $comment;
    }

    /**
     * Ajouter un commentaire
     */
    public function add()
    {
        if (!$this->request->isPost()) {
            $this->redirect('sendError', 'error', ['type' =>'wrongMethod']);
        }

        if (!$this->request->checkParams(['ref' => 'string', 'ref_id' => 'id'])) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $v = new Validator();
        if ($v->validate($_POST, $this->Comment->rules)) {
            $this->Comment->create($_POST['text'], $_GET['ref'], $_GET['ref_id']);
            Session::setFlash('Votre commentaire à bien été ajouté');
        } else {
            Session::setFlash('Veuillez verifier vos entrées', 'error');
            $v->sendError(['text']);
        }
        $this->redirect('view', $_GET['ref'], ['id' => $_GET['ref_id']]);
    }

    /**
     * Surpprimer un commentaire
     */
    public function delete()
    {
        if (!$this->request->checkParams(['ref' => 'string', 'ref_id' => 'id', 'comment_id' => 'id'])) {
            $this->redirect('sendError', 'error', ['type' =>'missingParams']);
        }

        $this->Comment->delete($_GET['comment_id']);
        $this->Comment->updateUserCount(Session::getId());
        Session::setFlash('Votre commentaire a bien été supprimé !');
        $this->redirect('view', $_GET['ref'], ['id' => $_GET['ref_id']]);
    }

} 