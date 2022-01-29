<?php

namespace FelixNagel\T3extblog\Controller;

/**
 * This file is part of the "t3extblog" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\T3extblog\Service\BlogNotificationService;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use FelixNagel\T3extblog\Domain\Model\Post;
use Psr\Http\Message\ResponseInterface;

/**
 * BackendPostController.
 */
class BackendPostController extends AbstractBackendController
{
    /**
     * Main Backendmodule: displays posts and pending comments.
     */
    public function indexAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'posts' => $this->postRepository->findByPage($this->pageId, false),
        ]);

        return $this->htmlResponse();
    }

    /**
     * Send post notification mails.
     */
    public function sendPostNotificationsAction(Post $post)
    {
        /* @var $notificationService BlogNotificationService */
        $notificationService = $this->objectManager->get(BlogNotificationService::class);
        $amount = $notificationService->notifySubscribers($post);

        $this->addFlashMessage(LocalizationUtility::translate('module.post.emailsSent', 'T3extblog', [$amount]));

        $this->redirect('index');
    }
}
