<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Exception\User;

/**
 * The <kbd>ExistingContactException</kbd> class represents the exception thrown when attempting to
 * add an existing Contact.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Exception.User
 * @subpackage Exception
 */
class ExistingContactException extends \RuntimeException
{
    public function __construct(\Hatchbuck\Entity\Contact $contact, $previous = null)
    {
        $contactData = [
            'contactId' => $contact->getContactId(),
            'emailList' => [],
        ];
        $emailList = $contact->getEmailList();
        if (!empty($emailList)) {
            foreach ($emailList as $emailEntity) {
                $contactData['emailList'][] = $emailEntity->getAddress();
            }
        }
        
        $message = 'Contact already exist. ' . json_encode($contactData);
        
        parent::__construct($message, \Hatchbuck\Exception\ExceptionCode::CONTACT_EXISTS, $previous);
    }
}
