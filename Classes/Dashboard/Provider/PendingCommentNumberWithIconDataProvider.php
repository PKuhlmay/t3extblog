<?php

namespace FelixNagel\T3extblog\Dashboard\Provider;

/**
 * This file is part of the "t3extblog" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\T3extblog\Domain\Repository\CommentRepository;
use TYPO3\CMS\Dashboard\Widgets\NumberWithIconDataProviderInterface;

class PendingCommentNumberWithIconDataProvider extends AbstractDataProvider implements NumberWithIconDataProviderInterface
{
    protected CommentRepository $commentRepository;

    
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @inheritDoc
     */
    public function getNumber(): int
    {
        return $this->commentRepository->findPendingByPage($this->getStoragePids())->count();
    }
}
