<?php

namespace FelixNagel\T3extblog\Dashboard\Provider;

/**
 * This file is part of the "t3extblog" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

class LatestCommentListDataProvider extends AbstractCommentListDataProvider
{
    public function getItems(): array
    {
        return $this->commentRepository->findByPage($this->getStoragePids())->toArray();
    }
}
