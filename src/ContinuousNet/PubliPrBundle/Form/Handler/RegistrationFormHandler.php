<?php

namespace ContinuousNet\PubliPrBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

class RegistrationFormHandler extends BaseHandler
{
    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false)
    {
        $user = $this->createUser();
        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);
            if ($this->form->isValid()) {
                $this->onSuccess($user, $confirmation);

                return true;
            }
            $errors = array();
            foreach ($this->form->getErrors(true, false) as $key => $error) {
                $errors[] = array('field' => $error->getForm()->getName(), 'message' => $error->current()->getMessage());
            }
            throw new \Exception(json_encode($errors));
        }

        return false;
    }

}