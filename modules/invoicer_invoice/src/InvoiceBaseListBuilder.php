<?php

namespace Drupal\invoicer_invoice;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Invoice base entities.
 *
 * @ingroup invoicer_invoice
 */
class InvoiceBaseListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    $header['date'] = $this->t('Date');
    $header['sub_total'] = $this->t('Subtotal price');
    $header['total'] = $this->t('Total price');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\invoicer_invoice\Entity\InvoiceBase */
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.invoice_base.canonical', [
          'invoice_base' => $entity->id(),
        ]
      )
    );
    $row['date'] = $entity->date->value;
    $row['sub_total'] = $entity->sub_total->value;
    $row['total'] = $entity->total->value;
    return $row + parent::buildRow($entity);
  }

}
